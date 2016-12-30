<?php
namespace ORM;

class Socket {
  static function count() {
    $cursor = \ORM\MongoDB::count('sockets', []);
    return $cursor;
  }
}
?>
