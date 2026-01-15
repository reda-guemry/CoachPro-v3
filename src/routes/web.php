<?php 

$router -> get ('/' , 'HomeController@index')  ;

$router -> get('register' , 'auth\AuthentificationController@showRegister') ; 
$router -> post('register' ,  'auth\AuthentificationController@register') ; 

$router -> get('login' , 'auth\AuthentificationController@showLogin' ) ;
$router -> post('login' , 'auth\AuthentificationController@login' ) ;


$router -> get('dhasbordcoach' , 'user\CoachController@index') ;
$router -> get('dhasbord' , 'user\SportifController@index') ;

$router -> post('dhasbordcoach/addavailibiliter' , 'user\CoachController@createNewAvail') ;
$router -> post('dhasbordcoach/removeavailibilty' , 'user\CoachController@removeavail') ;



