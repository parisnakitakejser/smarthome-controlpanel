<?php
# Composer setup
include_once '../packages/autoload.php';
require('../config.php');

use Philo\Blade\Blade;

function loadORM($dir){
	$ffs = scandir($dir);

	foreach($ffs as $ff){
		if($ff != '.' && $ff != '..'){
			if(is_dir($dir.'/'.$ff)) {
				loadORM($dir.'/'.$ff);
			} else {
				require($dir .'/'. $ff);
			}
		}
	}
}

loadORM(ORM_PATH);

ORM\MongoDB::$host = MONGODB_DB_HOST;
ORM\MongoDB::$port = MONGODB_DB_PORT;
ORM\MongoDB::$database = MONGODB_DB_NAME;
ORM\MongoDB::connect();

$controllersDirectory = ROOT_PATH . 'controllers';

// register the autoloader and add directories
Illuminate\Support\ClassLoader::register();
Illuminate\Support\ClassLoader::addDirectories([$controllersDirectory]);

// Instantiate the container
$app = new Illuminate\Container\Container();

// Tell facade about the application instance
Illuminate\Support\Facades\Facade::setFacadeApplication($app);

// register application instance with container
$app['app'] = $app;

// set environment
$app['env'] = 'production';

with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

include_once ROOT_PATH .'routes.php';

// Instantiate the request
$request = Illuminate\Http\Request::createFromGlobals();

try {
  $response = $app['router']->dispatch($request);
  $response->send();
} catch(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $notFound) {
  $blade = new Philo\Blade\Blade(BLADE_VIEWS, BLADE_CACHE);
  $bladeTemplate = 'error.404';
  $bladeData = [];

  with(new \Illuminate\Http\Response($blade->view()->make($bladeTemplate, $bladeData)->render(), 404))->send();
}
?>
