<?php
class Rooms {
  function listAll() {
    $rooms = ORM\MongoDB::find('rooms', []);

    $data = [];
    foreach($rooms AS $val) {
      $data[] = [
        'title' => $val['title'],
        'id' => $val['_id']
      ];
    }

    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'rooms.list';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'rooms' => $data
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }

  function createModal() {
    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'rooms/action/create';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'modal' => [
        'title' => 'Create new room',
        'btn' => [
          'onclick' => '$.rooms.push.create()',
          'title' => 'Create',
          'class' => ''
        ]
      ]
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }

  function create() {
    if(isset($_POST['room_title']) && $_POST['room_title'] != '') {
      $id = ORM\MongoDB::insertOne('rooms', [
        'title' => $_POST['room_title']
      ]);

      return [
        'status' => 200,
        'id' => $id
      ];
    } else {
      return [
        'status' => 404,
        'error' => [
          'header' => '',
          'msg' => ''
        ]
      ];
    }
  }

  function view($id) {
    $room = ORM\MongoDB::findOne('rooms', [
      '_id' => new MongoDB\BSON\ObjectID($id)
    ]);

    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'rooms.view';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'room' => [
        'title' => $room['title']
      ]
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }
}
?>
