<?php
class Lights {
  function listAll() {
    $lights = ORM\MongoDB::find('lights', []);

    $data = [];
    foreach($lights AS $val) {
      $utcdatetime = new MongoDB\BSON\UTCDateTime((string) $val['updated_at']);
      $datetime = $utcdatetime->toDateTime();

      $data[] = [
        'id' => (string) $val['_id'],
        'light_id' => $val['id'],
        'title' => (isset($val['name']) ? $val['name'] : 'untitled'),
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
        'state_on' => ($val['state']['reachable'] == true ? (int) $val['state']['on'] : 0),
        'reachable' => (int) $val['state']['reachable']
      ];
    }

    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    // exit();

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
