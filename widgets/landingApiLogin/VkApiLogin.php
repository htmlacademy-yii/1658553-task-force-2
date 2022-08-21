<?php
namespace app\widgets\landingApiLogin;

use yii\base\Widget;

class VkApiLogin extends Widget
{
    public function run()
    {
        return $this->render('vkLink');
    }

}