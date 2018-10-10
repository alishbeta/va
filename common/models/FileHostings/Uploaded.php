<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 06.04.2017
 * Time: 23:32
 */

namespace common\models\FileHostings;

use common\libraries\Http;
use common\models\Filehostings;
use common\models\Regulars;

class Uploaded extends Http
{
    private $id = 0;
    private $regulats = [];

    public function __construct($id)
    {
        parent::__contruct();
        $this->id = $id;
        $this->regulats = ["filesize" => Regulars::find(["type" => "filesize", "parent" => $this->id])->asArray()->one()];
    }

    public function isExist($urls = []){
        foreach ($urls as $k => $v) {
            $this->cookies = ['turbobit.net' => ['user_lang' => 'en']];
            $this->page[$k] = $this->get(urldecode($v));
            if (mb_strpos($this->page[$k], "Searching for the file") === true)
                $this->page[$k] = false;
        }
        return true;
    }

    public function getFileSize($urls = [])
    {
        foreach ($urls as $k => $v) {
            $page = $this->get(urldecode($v));
            preg_match($this->regulats['filesize'], $page, $out);
            $numb = preg_replace('#,#', '.', $out[1]);
            $size[$k] = Filehostings::ToByte($numb, $out[2]);
        }
        return $size;
    }

}