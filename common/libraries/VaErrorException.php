<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 11.06.2018
 * Time: 0:06
 */

namespace common\libraries;


use yii\base\ErrorException;

class VaErrorException extends ErrorException
{
    public function __construct($message = '', \Exception $previous = null, $code = 0)
    {
        parent::__construct($message, $code, $severity = 1, $filename = __FILE__, $lineno = __LINE__, $previous);
    }

}