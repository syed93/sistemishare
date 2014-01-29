<?php

// Getting a request instance
$request = new \Phalcon\Http\Request();

// Check whether the request was made with method POST
if ($request->isPost() == true) {

    // Check whether the request was made with Ajax
    if ($request->isAjax() == true) {
        echo "Request was made using POST and AJAX";
    } else {
		echo "Request Error";
	}
}
if(isset($_REQUEST['category'])) {
	$id = $_REQUEST['category'];
	
    if($id == 3 ) {
		//require_once('../../views/ajax/search/room_search.php');
		require_once('../apps/frontend/ajaxs/search/apartment_search.php');
	} elseif($id == 4) {
		require_once('../apps/frontend/ajaxs/search/apartment_search.php');
	} elseif($id == 5) {
		require_once('../apps/frontend/ajaxs/search/apartment_search.php');
	} elseif($id == 6) {
		require_once('../apps/frontend/ajaxs/search/apartment_search.php');
	} elseif($id == 7) {
		require_once('../apps/frontend/ajaxs/search/commercial_search.php');
	} elseif($id == 8) {
		require_once('../apps/frontend/ajaxs/search/land_search.php');
	} elseif($id == 10) {
		require_once('../apps/frontend/ajaxs/search/car_search.php');
	} elseif($id == 11) {
		require_once('../apps/frontend/ajaxs/search/newproperty_search.php');
	} 
}

 