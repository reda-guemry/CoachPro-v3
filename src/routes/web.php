<?php 

$router -> get ('/' , 'HomeController@index')  ;
$router -> get('register' , 'auth\AutentificationControllers@register') ; 

