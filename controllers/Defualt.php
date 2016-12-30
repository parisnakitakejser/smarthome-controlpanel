<?php
class Defualt {
  function temperature_chart() {
    $data = ORM\Sensor::chart_data([
      'uniqueid' => '00:17:88:01:02:01:6f:d3',
      'interval' => 10,
      'limit' => 50
    ]);

    return json_encode([
      'status' => 200,
      'content' => $data
    ]);
  }

  function main() {
    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'main.dashboard';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'counts' => [
        'sensors' => ORM\Sensor::count(),
        'lights' => ORM\Light::count(),
        'sockets' => ORM\Socket::count(),
        'users' => ORM\User::count(),
      ]
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
 }

 function main_login() {
   $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
   $bladeTemplate = 'main.login';
   $bladeData = [
     'meta' => [
       'title' => 'Smarthome'
     ]
   ];

   return $blade->view()->make($bladeTemplate, $bladeData)->render();
 }
}
?>
