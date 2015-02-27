<?php
/**
 * Created by PhpStorm.
 * User: s0201154
 * Date: 23-2-2015
 * Time: 16:35
 */

namespace App\IO;


interface FilesStream {

    public function hasNext();

    public function next();

}