<?php
class Sensors {
  function listAll() {
    $lights = ORM\MongoDB::find('sensors', []);

    $data = [];
    foreach($lights AS $val) {
      $utcdatetime = new MongoDB\BSON\UTCDateTime((string) $val['updated_at']);
      $datetime = $utcdatetime->toDateTime();

      if($val['battery'] <= 10) {
        $icon = 'battery-0';
        $class = 'text-danger';
      } elseif($val['battery'] <= 30) {
        $icon = 'battery-1';
        $class = 'text-warrning';
      } elseif($val['battery'] <= 60) {
        $icon = 'battery-2';
        $class = 'text-warrning';
      } elseif($val['battery'] <= 90) {
        $icon = 'battery-3';
        $class = 'text-success';
      } else {
        $icon = 'battery-4';
        $class = 'text-success';
      }

      $data[] = [
        'id' => $val['_id'],
        'title' => (isset($val['title']) ? $val['title'] : 'untitled'),
        'room' => [
          'title' => (isset($val['room']['title']) ? $val['room']['title'] : 'no room assigned'),
          'id' => (isset($val['room']['id']) ? $val['room']['id'] : ''),
        ],
        'hardware' => [
          'modelid' => isset($val['modelid']) ? $val['modelid'] : '',
          'brand' => isset($val['brand']) ? $val['brand'] : '',
          'icon' => ORM\Hardware\PhilipsHue::getIcon((isset($val['modelid']) ? $val['modelid'] : '')),
        ],
        'updated_at' => $datetime->format('Y-m-d H:i:s'),
        'battery' => [
          'procent' => $val['battery'],
          'icon' => $icon,
          'class' => $class
        ]
      ];
    }

    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'sensors.list';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'sensors' => $data
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }
}
?>
