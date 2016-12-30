<?php
require_once( substr_replace( dirname(__FILE__)  ,"",-11) .'/config.php');

$argvs = [];

if(isset($_SERVER['argv'])) {
  $argv = $_SERVER['argv'];
  foreach($argv AS $val) {
    $exp = explode('=', $val);
    if(count($exp) > 1) {
      $argvs[$exp[0]] = $exp[1];
    }
  }
}

if(isset($argvs['username']) && $argvs['password']) {
  $context = new PHPassLib\Application\Context;
  $context->addConfig('bcrypt', array ('rounds' => 16));

  $hash = $context->hash($argvs['password']);

  $mongo = new MongoDB\Client("mongodb://". MONGODB_DB_HOST .":". MONGODB_DB_PORT);
  $collection = $mongo->smarthome->users;

  $admin = (isset($argvs['admin']) ? $argvs['admin'] : 0 );

  $insertOneResult = $collection->insertOne([
    'username' => $argvs['username'],
    'password' => $hash,
    'admin' => $admin
  ]);

  echo "Success user created!\n";
} else {
  echo "Error: you need username and password!\n";
}
?>
