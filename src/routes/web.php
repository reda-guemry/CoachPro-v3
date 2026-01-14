<?php 

$router -> get ('/' , 'HomeController@index')  ;

$router -> get('register' , 'auth\AuthentificationController@showRegister') ; 
$router -> post('register' , action: 'auth\AuthentificationController@register') ; 



