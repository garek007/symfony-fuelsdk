<?php

use Slim\App;

return function (App $app) {
    // empty
};



{
    "require" : {
      "silex/silex": "^2.0.4",
      "monolog/monolog": "^1.22",
      "twig/twig": "^2.0",
      "guzzlehttp/guzzle":"~6.0",
      "salesforce-mc/fuel-sdk-php": "dev-getbufix as 1.3.2",
      "ext-soap": "*",
      "firebase/php-jwt":">=5.0.0",
      "symfony/twig-bridge": "^3",
      "slim/slim": "4.*",
      "slim/psr7": "^1.5"
    },
    "repositories":[
      {
        "type":"git",
        "url": "https://github.com/garek007/FuelSDK-PHP.git"
      }
    ],  
    "require-dev": {
      "heroku/heroku-buildpack-php": "*"
    },
    "autoload": {
      "psr-4": {
       "FuelSdk\\": "src",
       "MCHelper\\": "src",
       "App\\":"src/"
       }
     }  
  }
  