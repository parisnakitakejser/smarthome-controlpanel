<?php
class HomeAudios {
  function listAll() {
    $home_audios = ORM\MongoDB::find('home_audios', []);

    $data = [];
    foreach($home_audios AS $val) {
      $utcdatetime = new MongoDB\BSON\UTCDateTime((string) $val['updated_at']);
      $datetime = $utcdatetime->toDateTime();

      $brand = isset($val['device']['brand']) ? $val['device']['brand'] : '';
      $modelid = str_replace($brand,'',isset($val['device']['modelid']) ? $val['device']['modelid'] : '');

      $data[] = [
        'id' => $val['_id'],
        'title' => (isset($val['title']) ? $val['title'] : 'untitled'),
        'room' => [
          'title' => (isset($val['room']['title']) ? $val['room']['title'] : 'no room assigned'),
          'id' => (isset($val['room']['id']) ? $val['room']['id'] : ''),
        ],
        'hardware' => [
          'modelid' => $modelid,
          'brand' => $brand,
          'icon' => $val['device']['icon'],
        ],
        'state_on' => (isset($val['control']['status_light']) ? $val['control']['status_light'] : false),
        'mute' => (isset($val['control']['status_light']) ? $val['control']['mute'] : null),
        'volume' => (isset($val['control']['volume']) ? $val['control']['volume'] : null),
        'updated_at' => $datetime->format('Y-m-d H:i:s'),
      ];
    }

    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'home-audios.list';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'home_audios' => $data
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }

  function view($id) {
    $data = [];

    $home_audio = ORM\MongoDB::findOne('home_audios', [
      '_id' => new MongoDB\BSON\ObjectID($id)
    ]);

    $data = [
      'id' => $id,
      'device' => [
        'title' => $home_audio['title'],
        'brand' => $home_audio['device']['brand'],
        'model' => $home_audio['device']['modelid'],
        'uniqueid' => $home_audio['uniqueid'],
        'hardware_version' => $home_audio['device']['hardware_version'],
        'software_version' => $home_audio['device']['software_version']
      ],
      'network' => [
        'ip' => $home_audio['network']['ip'],
        'mac_address' => $home_audio['network']['mac_address']
      ],
      'control' => [
        'mute' => (int) $home_audio['control']['mute'],
        'power' => (int) $home_audio['control']['status_light'],
        'volume' => $home_audio['control']['volume'],
      ]
    ];

    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'home-audios.view';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'home_audio' => $data
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }

  function handlerMuteDevice() {
    $home_audio = ORM\MongoDB::findOne('home_audios', [
      '_id' => new MongoDB\BSON\ObjectID($_POST['id'])
    ]);

    $response = ORM\Curl::exec([
      'path' => 'home-audio/sonos/mute',
      'postfield' => [
        'ip' => $home_audio['network']['ip']
      ]
    ]);

    $response_json = json_decode($response);

    if($response_json->status == 200) {
      return [
        'status' => 200
      ];
    } else {
      return [
        'status' => 404,
        'error' => [
          'header' => 'Error!',
          'msg' => $response_json->msg
        ]
      ];
    }
  }

  function handlerTurnOnDevice() {
    return [
      'status' => 200
    ];
  }

  function handlerControlAction() {
    $home_audio = ORM\MongoDB::findOne('home_audios', [
      '_id' => new MongoDB\BSON\ObjectID($_POST['id'])
    ]);

    $response = ORM\Curl::exec([
      'path' => 'home-audio/sonos/control-action',
      'postfield' => [
        'method' => $_POST['method'],
        'value' => $_POST['value'],
        'ip' => $home_audio['network']['ip'],
      ]
    ]);

    $response_json = json_decode($response);

    if($response_json->status == 200) {
      $status = 200;
    } else {
      $status = 404;
    }

    return [
      'status' => $status
    ];
  }
}
?>
