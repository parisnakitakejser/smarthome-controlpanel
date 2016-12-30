<?php
if(isset($_SESSION['user'])) {
  $app['router']->get('/', 'Defualt@main');
  $app['router']->post('/dashboard/temperature_chart', 'Defualt@temperature_chart');

  $app['router']->get('/rooms', 'Rooms@listAll');
  $app['router']->get('/rooms/create', 'Rooms@createModal');
  $app['router']->post('/rooms/create', 'Rooms@create');
  $app['router']->get('/rooms/view/{id}', 'Rooms@view');

  $app['router']->get('/lights', 'Lights@listAll');

  $app['router']->get('/sensors', 'Sensors@listAll');

  $app['router']->get('/sockets', 'Sockets@listAll');

  $app['router']->get('/users', 'Users@listAll');
} else {
  if($_SERVER['REQUEST_URI'] != '/' && $_SERVER['REQUEST_URI'] != '/users/login' ) {
    header('location: /');
    exit();
  }

  $app['router']->post('/users/login', 'Users@login');
  $app['router']->get('/', 'Defualt@main_login');
}
?>