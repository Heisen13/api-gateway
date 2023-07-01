<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'client.credentials'], function() use ($router) {

    $router->get('/reports', 'User3Controller@reportAllAttendances');
    $router->get('/reports/user/{userId}', 'User3Controller@reportUserAttendances');
    $router->get('/reports/{id}', 'User3Controller@reportAttendances'); 

});

    $router->post('/register', 'User1Controller@register'); 
    $router->post('/login', 'User1Controller@login');

    $router->get('/profile', ['middleware' => 'auth', 'uses' => 'User1Controller@profile']);
    $router->put('/update', ['middleware' => 'auth', 'uses' => 'User1Controller@update']);
    $router->delete('/delete', ['middleware' => 'auth', 'uses' => 'User1Controller@delete']);

    $router->post('/checkin', ['middleware' => 'auth', 'uses' => 'User2Controller@checkIn']);
    $router->post('/checkout', ['middleware' => 'auth', 'uses' => 'User2Controller@checkOut']);