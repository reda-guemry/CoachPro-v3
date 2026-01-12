<?php 

spl_autoload_register(function ($class) {
    $realpath =  [
        'src\\core' => SRC_PATH  . '/core/' ,
        'src\\app\\Controllers' => SRC_PATH . '/app/Controllers' ,
        'src\\app\\Models' => SRC_PATH . '/app/Models' ,

    ] ;


}) ;