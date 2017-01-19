<?php
namespace ORM;

class Curl {
  static function exec($argv) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,'http://'. SMARTHOME_API_HOST .'/'. $argv['path']);
    curl_setopt($ch, CURLOPT_POST, 1);

    if(count($argv['postfield']) > 0) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($argv['postfield']));
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);

    return $server_output;
  }
}
?>
