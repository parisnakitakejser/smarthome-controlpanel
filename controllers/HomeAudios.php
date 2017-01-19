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
}
?>
