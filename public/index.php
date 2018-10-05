<?php

use App\Services\GoogleMapAPI;
use Jenssegers\Blade\Blade;

require __DIR__ . '/../vendor/autoload.php';

// Loading blade template engine
$blade = new Blade('../views', '../cache');

if($_GET && $_GET['address']) {
	$googleMapAPI = new GoogleMapAPI();
	$addresses    = $googleMapAPI->setAddress( $_GET['address'] )->find();

	echo $blade->make('details', compact('addresses'));
} else {
	echo $blade->make('homepage');
}
