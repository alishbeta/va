<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 02.07.2018
 * Time: 22:10
 */

namespace common\libraries;

use common\models\PremiumKeys;
use common\models\Servers;

class Balancer
{
    public static function init($fh_id){
        $premium = PremiumKeys::findAll(['fh_id' => $fh_id]);
        if (count($premium) == 1)
            return $premium[0]->id;
    }
}