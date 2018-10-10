<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 06.06.2018
 * Time: 21:23
 */
namespace app\modules\core\libraries;

use yii\web\ErrorHandler;

class CoreErrorHandler extends ErrorHandler
{
    /** @inheritdoc */
    public static function convertExceptionToString($exception)
    {
        return $exception->getMessage();
    }

    protected function convertExceptionToArray($exception)
    {
        return [
            'error' => $exception->getMessage(),
            'code' => $exception->getCode()
        ];
    }
}