<?php
namespace ORM;

class Light {
  static function count() {
    $cursor = \ORM\MongoDB::count('lights', []);
    return $cursor;
  }
}
?>
