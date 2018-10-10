<?php

namespace app\modules\core;

use app\modules\core\libraries\CoreErrorHandler;
use bedezign\yii2\audit\components\web\ErrorHandler;
use yii\web\Response;

class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\core\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $errorHandler = new ErrorHandler();
        \Yii::$app->set('errorHandler', $errorHandler);
        $errorHandler->register();
        \Yii::$app->errorHandler->errorAction = 'core/default/error';
        \Yii::$app->response->format =  Response::FORMAT_JSON;
        \Yii::configure($this, require(__DIR__ . '/config.php'));

        //\Yii::$app->user->enableSession = false;
        // custom initialization code goes here
    }

}
