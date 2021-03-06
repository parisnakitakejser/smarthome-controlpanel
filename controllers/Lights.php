<?php
class Lights {
  function listAll() {
    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'lights.list';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ]
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }

  function view($id) {
    $light = ORM\MongoDB::findOne('lights', [
      '_id' => new MongoDB\BSON\ObjectID($id)
    ]);

    if(isset($light['_id'])) {
      $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
      $bladeTemplate = 'lights.view';
      $bladeData = [
        'meta' => [
          'title' => 'Smarthome'
        ],
        'light' => $light
      ];

      return $blade->view()->make($bladeTemplate, $bladeData)->render();
    } else {
      header('location: /');
      exit();
    }
  }

  function getAll() {
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

    return [
      'content' => $data,
      'status' => 200
    ];
  }

  function handlerControlAction() {
    $light = ORM\MongoDB::findOne('lights', [
      '_id' => new MongoDB\BSON\ObjectID($_POST['id'])
    ]);

    switch(strtolower($light['manufacturer'])) {
      case 'philips':
        $url_path = REST_API_PHILIPS_HUE .'philips-hue/light';
        break;

      default:
        $url_path = null;
        break;
    }

    $postfield = [];

    switch(strtolower($_POST['method'])) {
      case 'on':
        $postfield['num'] = $light['id'];
        $postfield['on'] = ($_POST['value'] == 1 ? True : False);
        break;

      case 'name':
        $postfield['num'] = $light['id'];
        $postfield['name'] = $_POST['value'];
        break;
    }

    if($url_path !== null) {
      $response = ORM\Curl::exec([
        'path' => $url_path,
        'postfield' => $postfield
      ]);
      
      $response_json = json_decode($response)[0];
      if($response_json->status == 200) {
        $status = 200;
      } else {
        $status = 404;
      }

      return [
        'status' => $status
      ];
    } else {
      return [
        'status' => 404
      ];
    }
  }
}
?>
