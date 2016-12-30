<?php
class Sockets {
  function listAll() {
    $lights = ORM\MongoDB::find('sockets', []);

    $data = [];

    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'sockets.list';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'sockets' => $data
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }
}
?>
