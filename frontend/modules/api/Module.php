<?php

namespace app\modules\api;
use yii\filters\auth\QueryParamAuth;

/**
 * api2 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config.php'));

        \Yii::$app->user->enableSession = false;
        
        // custom initialization code goes here
    }
}
