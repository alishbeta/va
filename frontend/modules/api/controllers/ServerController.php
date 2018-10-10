<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;

class ServerController extends ActiveController
{
    public $modelClass = 'app\models\servers\Servers';

}
