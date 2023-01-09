<?php
// public/index.php
use App\Kernel;
use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\HttpFoundation\Request;
//use FuelSdk\ET_Client;
// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', '1');

$loader = require __DIR__.'/../vendor/autoload.php';
// auto-load annotations
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$kernel = new Kernel('dev', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);


/*
$myclient = new ET_Client(true,false, array(
    'appsignature' => 'none',
    'clientid' => 'a2m20fnm6g82zhdviesi92hf',
    'clientsecret' => 'tzjMsIwO2nFITFO5jMrYyZvt',
    'defaultwsdl' => 'https://webservice.exacttarget.com/etframework.wsdl',
    'xmlloc' => dirname(__DIR__,1).'/ExactTargetWSDL.xml',     
    'baseAuthUrl' => 'https://mcr17n1zhy4rq421ykqpt4s9xwn4.auth.marketingcloudapis.com/',
    'baseSoapUrl' => 'https://mcr17n1zhy4rq421ykqpt4s9xwn4.soap.marketingcloudapis.com/',
    'baseUrl' => 'https://mcr17n1zhy4rq421ykqpt4s9xwn4.rest.marketingcloudapis.com/',    
    'useOAuth2Authentication' => true,
    'accountId' => 8219903
    ));
  //$myclient = new Client();
  dump($myclient);
  $authtoken = $myclient->getAuthToken();
  var_dump($myclient->getAuthTokenExpiration(null));

  */