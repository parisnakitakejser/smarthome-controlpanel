<?php
class Users {
  function login() {
    $username = (isset($_POST['username']) ? $_POST['username'] : '');
    $password = (isset($_POST['password']) ? $_POST['password'] : '');

    $mongo = new MongoDB\Client("mongodb://". MONGODB_DB_HOST .":". MONGODB_DB_PORT);
    $collection = $mongo->smarthome->users;
    $user = $collection->findOne(['username' => $username]);

    $context = new PHPassLib\Application\Context;
    $context->addConfig('bcrypt', array ('rounds' => 16));

    if ($user['password'] != '' && $context->verify($password, $user['password'])) {
      $_SESSION['user']['id'] = $user['_id'];
      $_SESSION['user']['admin'] = $user['admin'];

      $json = [
        'status' => 200,
      ];

    } else {
      $json = [
        'status' => 404,
        'error' => [
          'header' => 'Login error',
          'msg' => 'Your username or password are not current'
        ]
      ];
    }

    return json_encode($json);
  }

  function listAll() {
    $lights = ORM\MongoDB::find('users', []);

    $data = [];

    $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
    $bladeTemplate = 'users.list';
    $bladeData = [
      'meta' => [
        'title' => 'Smarthome'
      ],
      'users' => $data
    ];

    return $blade->view()->make($bladeTemplate, $bladeData)->render();
  }
}
?>
