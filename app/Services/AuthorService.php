<?php

namespace App\Services;

use App\Models\AuthorModel;

class AuthorService
{

    private $authorModel;

    public function __construct()
    {
        $this->authorModel = new AuthorModel();
    }


    public function all(): array
    {
        $authors = $this->authorModel->findAll();
        $result = array();
        foreach ($authors as $a) {
            $pinyin = pinyin($a['name']);
            if (empty($pinyin)) {
                $pinyin = '0';
            }
            $pinyin = ucfirst($pinyin);
            $f = substr($pinyin, 0, 1);
            if (!array_key_exists($f, $result)) {
                $result[$f] = array();
            }
            $arr = &$result[$f];
            array_push($arr, $a);
        }
        return $result;
    }

}