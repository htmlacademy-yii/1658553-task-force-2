<?php

namespace app\controllers;

use app\models\Cities;
use GuzzleHttp\Client;
use SimpleXMLElement;
use Yii;
use yii\web\Controller;
use Symfony\Component\DomCrawler\Crawler;

class ApiController extends Controller
{
    public function actionIndex()
    {
        https://geocode-maps.yandex.ru/1.x/?=

        foreach (Yii::$app->request->get() as $getParamsKey=>$getParamsValue){
            if ($getParamsKey !=='/api/index'){
                $queryString = str_ireplace('_','+',$getParamsKey);
            }
        }


        $client = new Client(['base_uri' => 'https://geocode-maps.yandex.ru/1.x/']);
        $response = $client->request('GET', '', [
            'query' => [

                'apikey' => 'e666f398-c983-4bde-8f14-e3fec900592a',
                'geocode' => "$queryString"
            ],
        ]);






        $crawler = new Crawler("https://geocode-maps.yandex.ru/1.x/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&geocode=$queryString","https://geocode-maps.yandex.ru/1.x/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&geocode=$queryString");
        $crawler->filter('text');
        var_dump($crawler->filter('text'));
//        foreach ($crawler as $test){
//            var_dump($test->nodeName);
//        }



//        return json_encode($anime);

    }



}