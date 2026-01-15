<?php 

$router -> get ('/' , 'HomeController@index')  ;

$router -> get('register' , 'auth\AuthentificationController@showRegister') ; 
$router -> post('register' ,  'auth\AuthentificationController@register') ; 

$router -> get('login' , 'auth\AuthentificationController@showLogin' ) ;
$router -> post('login' , 'auth\AuthentificationController@login' ) ;

