<?php
session_start();
require('../vendor/autoload.php');
use GuzzleHttp\Client;
use FuelSdk\ET_Client;
use Symfony\Component\HttpFoundation\Request;



use MCHelper\MC_DataExtension;
use MCHelper\MC_Config;



$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->get('/pdflooper', function() use($app) {
  return $app['twig']->render('pdflooper.twig');
});
$app->get('/loadit/{externalkey}', function($externalkey) use($app) {
  $app['monolog']->addDebug('logging output.');
 
   //put this in a class or something and return the parms, can call client here tho
   

    if( isset($_SESSION['start_time']) ){
      $start_date = new DateTime($_SESSION['start_time']->date);
      $since_start = $start_date->diff(new DateTime());
      //echo $since_start->days.' days total<br>';
      //echo $since_start->y.' years<br>';
      //echo $since_start->m.' months<br>';
      //echo $since_start->d.' days<br>';
      //echo $since_start->h.' hours<br>';
      //echo $since_start->i.' minutes<br>';
      //echo $since_start->s.' seconds<br>';
      //echo $since_start->invert.'<br>';
      $activeToken = $since_start->invert;// 0 or 1
    }else{
      $activeToken = 0;
    }
    //echo 'Expired '.$activeToken;
 
   if($since_start->i < 1 ){
     //echo 'we winding down yo!';
   }
 
  
  $config = new MC_Config('8219903');
  $now = new DateTime();

  if( $activeToken == 0 ){
    $myclient = new ET_Client(true,false, $config->config );
    $_SESSION['client'] = serialize($myclient);
    
    $start = new DateTime();    
    $start->add(new DateInterval('PT20M'));
    $_SESSION['start_time'] = $start;
    
  }else{
    $myclient = unserialize($_SESSION['client']);
  }
  



  //$get = new ET_Account();
  //$get->authStub = $myclient;

  $de = new MC_DataExtension($externalkey,$myclient);//should I pass client here, instead of on the method??
  $columns = $de->getDEColumns();
  $rows = $de->getDERows($columns);
	
 


  return $app['twig']->render('routing.twig',array(
    'columns'=>$columns,
    'rows'=>$rows
  ));
});
$app->post('/createwtl', function(Request $request) use($app) {
  
  $myclient = unserialize($_SESSION['client']);
  $de = new MC_DataExtension('WTL_Test',$myclient);
  echo $_SESSION['start_time']->date;
  //$de->addRow($request->request->all());

});
$app->get('/setupwtl', function() use($app) {
  $app['monolog']->addDebug('logging output.');
 
   //put this in a class or something and return the parms, can call client here tho
    $externalkey = 'WTL_Fields';

    if( isset($_SESSION['start_time']) ){
      $start_date = new DateTime($_SESSION['start_time']->date);
      $since_start = $start_date->diff(new DateTime());

      $activeToken = $since_start->invert;// 0 or 1
    }else{
      $activeToken = 0;
    }
    
 
  
  $config = new MC_Config('8219903');
  $now = new DateTime();

  if( $activeToken == 0 ){
    $myclient = new ET_Client(true,false, $config->config );
    $_SESSION['client'] = serialize($myclient);
    
    $start = new DateTime();    
    $start->add(new DateInterval('PT20M'));
    $_SESSION['start_time'] = $start;
    
  }else{
    $myclient = unserialize($_SESSION['client']);
  }
  
  $de = new MC_DataExtension($externalkey,$myclient);
  $columns = $de->getDEColumns();
  $rows = $de->getDERows($columns);

  
	
  return $app['twig']->render('setupwtl.twig',array(
    'columns'=>$columns,
    'rows'=>$rows
  ));
});






$app->get('/loaditform/{args}', function($args) use($app) {
  $app['monolog']->addDebug('logging output.');
 
   //put this in a class or something and return the parms, can call client here tho
    var_dump($args);
  

  return $app['twig']->render('routing2.twig',array(
    'columns'=>$columns,
    'rows'=>$rows
  ));
});










$app->run();
