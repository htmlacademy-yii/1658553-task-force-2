<?php

namespace app\controllers;


use app\models\Cities;
use app\models\Users;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use Yii;
use yii\authclient\clients\VKontakte;
use yii\web\Controller;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;


    public function actionIndex()
    {
        $queryString = urlencode(file_get_contents('php://input'));

        $httpClient = new Client();

        $response = $httpClient->get(
            "https://geocode-maps.yandex.ru/1.x/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&geocode=$queryString"
        );
        $htmlString = (string)$response->getBody();
        //add this line to suppress any warnings
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($htmlString);
        $xpath = new DOMXPath($doc);
        $titles = $xpath->evaluate('//text');
        $extractedTitles = [];
        foreach ($titles as $title) {
            $extractedTitles[] = $title->textContent.PHP_EOL;
        }

        return json_encode($extractedTitles);
    }


    public function actionLogin()
    {
        return '2 стадия';
    }

    public function actions()
    {
        return [
            'social' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    /**
     * @param $client
     */
    public function successCallback($client)
    {
        $day = 86400;
        $client_id = Yii::$app->request->get('authclient');
        $attributes = $client->getUserAttributes();


        // VK
        if ($client instanceof VKontakte) {
            $request = $client->getAccessToken()->getParams();
            $email = $request['email'];

            $vk_data_response = $client->api(
                'users.get',
                'GET',
                [
                    'uids' => $attributes['user_id'],

                    'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,city',

                    'access_token' => $request['access_token'],
                    'v'            => '5.101',
                ]
            );


            if (Cities::find()->where(['name' => $vk_data_response['response'][0]['city']['title']])->one()) {
                $city = Cities::find()->where(['name' => $vk_data_response['response'][0]['city']['title']])->one();
            } else {
                $city = Cities::find()->where(['name' => 'Москва'])->one();
            }


            $user = Users::find()->where(['email' => $email])->one();

            if ($user) {
                \Yii::$app->user->login($user);
            } else {
                $newUser = new Users();
                $newUser->email = $email;
                $newUser->create_date = date('Y-m-d H:i:s');
                $newUser->login = $vk_data_response['response'][0]['first_name'];
                $newUser->password = null;
                $newUser->city_id = $city->id;
                $newUser->auth_via = 'vk';
                $newUser->avatar_file_id = 1;
                $newUser->contact_phone = null;
                $newUser->birthday = null;
                $newUser->info = null;
                $newUser->rating = null;
                $newUser->status = null;

                $newUser->social_id = (string)$attributes['user_id'];
                $newUser->contact_telegram = null;
                $newUser->save();


                \Yii::$app->user->login($newUser);
            }
        }
    }
}
