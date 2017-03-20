<?php
namespace ORM;

class Curl {
  static function exec($argv) {
    $ch = curl_init();

    $data_json = json_encode($argv['postfield']);
    curl_setopt($ch, CURLOPT_URL,$argv['path']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);

    return $server_output;
  }
}
?>
