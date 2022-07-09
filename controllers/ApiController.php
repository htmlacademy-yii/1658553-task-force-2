<?php

namespace app\controllers;

use app\models\Cities;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use SimpleXMLElement;
use Yii;
use yii\web\Controller;
use Symfony\Component\DomCrawler\Crawler;

class ApiController extends Controller
{
    public function actionIndex()
    {

        foreach (Yii::$app->request->get() as $getParamsKey=>$getParamsValue){
            if ($getParamsKey !=='/api/index'){
                $queryString = str_ireplace('_','+',$getParamsKey);
            }
        }



        $httpClient = new Client();

        $response = $httpClient->get("https://geocode-maps.yandex.ru/1.x/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&geocode=$queryString");
        $htmlString = (string) $response->getBody();
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



}