<?php
// src/Controller/LoadDataExtension.php
namespace App\Controller;
// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', '1');
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

//use MCHelper\MC_DataExtension;
use App\MCHelper\MC_Config;
use App\MCHelper\MC_DataExtension;

use FuelSdk\ET_Client;

class LoadDataExtension extends AbstractController
{
    /**
     * @Route("/loadit/{externalkey}")
     */
    public function loadit(string $externalkey): Response
    {



        //$response->getBody()->write('Hello, World!');
        //echo $_SERVER['REQUEST_URI'];


/*
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
       */
   

        $config = new MC_Config('8219903');
     
        $now = new \DateTime();
        dump($now);
        
      

        //if( $activeToken == 0 ){
          
      
          $myclient = new ET_Client(true,false, $config->params);
          //$myclient = new Client();
      
          dump($myclient->getAuthTokenExpiration(null));


          $de = new MC_DataExtension($externalkey,$myclient);//should I pass client here, instead of on the method??
          $columns = $de->getDEColumns();
          $rows = $de->getDERows($columns);
          
        
          //$_SESSION['client'] = serialize($myclient);
          
          //$start = new DateTime();    
          //$start->add(new DateInterval('PT20M'));
          //$_SESSION['start_time'] = $start;
          
        //}else{
          //$myclient = unserialize($_SESSION['client']);
        //}
        
        //$get = new ET_Account();
        //$get->authStub = $myclient;

  

        return $this->render('routing.twig', [
          'columns'=>$columns,
          'rows'=>$rows
        ]);



        //$number = random_int(0, $limit);

        //return $this->render('loadit.twig');
    }
}


