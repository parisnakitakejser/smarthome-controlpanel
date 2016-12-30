<?php
namespace ORM;

class User {
  static function count() {
    $cursor = \ORM\MongoDB::count('users', []);
    return $cursor;
  }
}
?>
