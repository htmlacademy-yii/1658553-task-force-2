<?php

namespace app\controllers;

use app\models\Cities;
use GuzzleHttp\Client;
use Yii;
use yii\web\Controller;

class ApiController extends Controller
{
    public function actionIndex()
    {
        $city = Cities::find()->where("id = 345")->one();



        $vkId = "80834767";
        $accessToken
            = 'vk1.a.K7_RMET2TA9hfTgH0hH3yz7ZmOTTfwVazyqORVnipdi1Zq0mFOCCrrPYlBFC_ffNFsng0WxZOeAKp0-6TPwaQ2PE-Y03qJbRBFvxcuUGuH_dORPfeVOa3zLG03z2KDaWTpuEz6FWbjtEFuxkSeWn6qLaDtjo4xokLmv65v0RxbCyhP8qcgItAl0TTiv_Hh0c';
        $client = new Client(['base_uri' => 'https://api.vk.com/method/']);
        $response = $client->request('GET', 'users.get', [
            'query' => [
                'user_id' => "$vkId",
                'v' => '5.131',
                'access_token' => "$accessToken",
            ],
        ]);
        $content = $response->getBody()->getContents();
        $response_data = json_decode($content, true);
        var_dump($response_data);
    }

}