<?php
class Lights {
  function listAll() {
    $lights = ORM\MongoDB::find('lights', []);

    $data = [];
    foreach($lights AS $val) {
      $utcdatetime = new MongoDB\BSON\UTCDateTime((string) $val['updated_at']);
      $datetime = $utcdatetime->toDateTime();

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
          'icon' => ORM\Hardware\PhilipsHue::getIcon($val['modelid']),
        ],
        'updated_at' => $datetime->format('Y-m-d H:i:s'),
        'state_on' => $val['state']['on']
      ];
    }

    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'lights.list';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'lights' => $data
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }
}
?>
