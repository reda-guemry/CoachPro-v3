<?php 


spl_autoload_register(function ($class) {
    $realpath =  [
        'core\\' => SRC_PATH  . '/core/' ,
        'src\\app\\Controllers' => SRC_PATH . '/app/Controllers' ,
        'src\\app\\Models' => SRC_PATH . '/app/Models' ,
    ] ;
    foreach($realpath as $namespace => $path) {
        $len = strlen($namespace) ;
        if(strncmp($namespace , $class , $len ) !== 0) continue ;
        
        $classNAme = substr($class , $len) ;
        $filepath = $path . str_replace('\\' , '/' , $classNAme) . '.php' ;
        if (file_exists($filepath)) {
            require $filepath ; 
            return ;
        }
    }

    
}) ;