<?php

namespace app\controllers;


use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;


class ApiController extends Controller
{

    public function actionIndex()
    {
        $queryString = urlencode(file_get_contents('php://input'));

        $httpClient = new Client();

        $response = $httpClient->get("https://geocode-maps.yandex.ru/1.x/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&geocode=$queryString");
        $htmlString = (string)$response->getBody();
        //add this line to suppress any warnings
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($htmlString);
        $xpath = new DOMXPath($doc);
        $titles = $xpath->evaluate('//text');
        $extractedTitles = [];
        foreach ($titles as $title) {
            $extractedTitles[] = $title->textContent . PHP_EOL;

        }

        return json_encode($extractedTitles);

    }


}