<?php
// More Docs https://php-on-couch.readthedocs.io/en/latest/api/couchclient/document.html#getdoc

//We need to use an autoloader to import PHPOnCouch classes
//I will use composer's autoloader for this demo
$autoloader = join(DIRECTORY_SEPARATOR,[__DIR__,'../vendor','Autoload.php']);
require $autoloader;

//We import the classes that we need
use PHPOnCouch\CouchClient;
use PHPOnCouch\Exceptions;

//We create a client to access the database
$client = new CouchClient('http://admin:supermario123@31.232.227.108:5984','app_meunoperu_regi2ter');

//We create the database if required
if(!$client->databaseExists()){
    $client->createDatabase();
}

//We get the database info just for the demo
// var_dump($client->getDatabaseInfos());