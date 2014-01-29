<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;

class GraphController extends ControllerBase {
	
	public function initialize() {
		$this->tag->setTitle('User ePins');
		parent::initialize();
	}
	
	public function usernameAction() {
		$this->view->disable();
		
		$term=$_GET["term"];
		
		$phql = "SELECT username FROM JunMy\Models\Users WHERE username like '%".$term."%' order by username ASC LIMIT 15";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		$json = '[';
        $first = true;
		foreach($rows as $row) {
			if (!$first) { 
			    $json .=  ','; } else { $first = false; 
			}
            $json .= '{"value":"'.$row['username'].'"}';
		}  
		$json .= ']';
        echo $json;	
		
	}

	 
}