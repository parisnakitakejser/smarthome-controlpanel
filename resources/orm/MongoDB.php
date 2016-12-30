<?php
namespace ORM;

class MongoDB {
	static $_db = null;
	static $host = '127.0.0.1';
	static $port = '27017';
  static $database = '';
  static $username = '';
  static $password = '';

	private static $_limit = 0;
	private static $_skip = null;
	private static $_sort = [];

	static function connect() {
		try {
			if ( self::$_db == null ) {
				if(self::$username != '') {
					$m = new \MongoDB\Client('mongodb://'. self::$username .':'. self::$password .'@'. self::$host .':'. self::$port .'/admin');
				} else {
					$m = new \MongoDB\Client('mongodb://'. self::$host .':'. self::$port);
				}

				self::$_db = $m->{self::$database};
			}

			return self::$_db;
		} catch (MongoConnectionException $e) {
			print '<p>'. _('Couldn\'t connect to mongodb, is the "mongo" process running?') .'</p>';
			die();
		}
	}

  static function count($collection, array $argv = []) {
    $collection = self::$_db->{$collection};
    $cursor = $collection->count($argv);

    return $cursor;
  }

  static function aggregate($collection, array $argv = []) {
    $collection = self::$_db->{$collection};
    $cursor = $collection->aggregate($argv);

    return $cursor;
  }

  static function insertOne($collection, array $argv = []) {
    $collection = self::$_db->{$collection};
    $cursor = $collection->insertOne($argv);

    return (string) $cursor->getInsertedId();
  }

  static function findOne($collection, array $argv = []) {
    $collection = self::$_db->{$collection};
    $cursor = $collection->findOne($argv);

    return $cursor;
  }

  static function find($collection, array $argv = []) {
    $collection = self::$_db->{$collection};
    $cursor = $collection->find($argv);

    return $cursor;
  }
}
?>
