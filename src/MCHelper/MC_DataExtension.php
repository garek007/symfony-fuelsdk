<?php
// spl_autoload_register( function($class_name) {
//     include_once 'src/'.$class_name.'.php';
// });
namespace App\MCHelper;
use FuelSdk\ET_DataExtension_Column;
use FuelSdk\ET_DataExtension_Row;

class MC_DataExtension
{
	/**
	* @var int 	Gets or sets the folder identifier.
	*/
	public  $folderId;

    /**
    * Initializes a new instance of the class and will assign obj, folderProperty, folderMediaType property 
    */ 	
	function __construct($externalKey,$client)
	{
		$this->obj = "Account";
		$this->folderProperty = "CategoryID";
		$this->client = $client;
		$this->key = $externalKey;
		//$this->folderMediaType = "query";
	}
	public function getDEColumns(){
		$getDEColumns = new ET_DataExtension_Column();
		$getDEColumns->authStub = $this->client;
		$getDEColumns->props = array("CustomerKey", "Name");	
		$getDEColumns->filter = array('Property' => 'CustomerKey','SimpleOperator' => 'equals','Value' => $this->key);
		$g = $getDEColumns->get();
	  
	  if(count($g->results) > 0 ){
		$columns = array();
		foreach($g->results as $column){
		  $columns[] = $column->Name;
		}
	  }else{
		$columns = array("LeadOrContactId", "FirstName","LastName","Language");
	  }
	  return $columns;
	}
	public function getDERows($columns){

		$getDERows = new ET_DataExtension_Row();
		$getDERows->authStub = $this->client;
	  
		$getDERows->props = $columns;
		$getDERows->CustomerKey = $this->key;
		$g = $getDERows->get();
	 
	
	
	  if(count($g->results)> 0){
		//output header row
	   
		$rows = array();
		foreach($g->results as $result){
		  $obj = array();
		  //var_dump($result->Properties);
		  //echo $result->Properties->Property['LeadOrContactId'];
		  foreach($result->Properties->Property as $item){
			$obj[$item->Name] = $item->Value;
		  }
		  $rows[] = $obj;
		}

	
	  }//endif

	  return $rows;
	
	}
	public function addRow(){

		$getDERows = new ET_DataExtension_Row();
		$getDERows->authStub = $this->client;
	  
		$getDERows->props = array("VanityURL"=>"yoyoyoyoyoasf","CampaignId"=>"yoyoyoyoyo","ContentBlockID"=>123456);

		
		
		$getDERows->CustomerKey = $this->key;
		$g = $getDERows->post();
	 
		echo '<pre>';
		var_dump($g);
		echo '</pre>';
	}	
}
?>