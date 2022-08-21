<?php

namespace app\services\user;

class ApiLoginUser
{
    public static function successCallback()
    {
        $client_id = 8218890; // ID приложения
        $client_secret = 'dyLk6crlBKxsaFjIZQvH'; // Защищённый ключ
        $redirect_uri = 'http://localhost/api/login'; // Адрес сайта

        $url = 'http://oauth.vk.com/authorize'; // Ссылка для авторизации на стороне ВК

        $params = [ 'client_id' => $client_id, 'redirect_uri'  => $redirect_uri, 'response_type' => 'code','scope'=>'email']; //
        // Массив данных, который нужно передать для ВК содержит ИД приложения код, ссылку для редиректа и запрос code для дальнейшей авторизации токеном



            echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';


        if (isset($_GET['code'])) {
            $result = true;
            $params = [
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'code' => $_GET['code'],
                'redirect_uri' => $redirect_uri
            ];

            $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
            var_dump($token);

            if (isset($token['access_token'])) {
                $params = [
                    'uids' => $token['user_id'],
                    'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,email',
                    'access_token' => $token['access_token'],
                    'v' => '5.101'];

                $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['response'][0]['id'])) {
                    $userInfo = $userInfo['response'][0];
                    $result = true;
                }
            }


            if ($result) {
                echo "ID пользователя: " . $userInfo['id'] . '<br />';
                echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
                echo "Ссылка на профиль: " . $userInfo['screen_name'] . '<br />';
                echo "Пол: " . $userInfo['sex'] . '<br />';
                echo "День Рождения: " . $userInfo['bdate'] . '<br />';
                echo '<img src="' . $userInfo['photo_big'] . '" />'; echo "<br />";
                echo $token['email'];

            }
        }
    }

}