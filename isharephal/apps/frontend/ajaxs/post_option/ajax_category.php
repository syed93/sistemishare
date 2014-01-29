<?php

define('AJAX', '../views/ajax/');


if($_POST['category']) {
//echo $_POST['category'];
$id = $_POST['category'];
if($id == 1) {
 
	require_once(AJAX . 'carOption.php');
	
} elseif($id == 2) {
 
	require_once(AJAX . 'priceOptionMotorcycle.php');
	
} elseif($id == 6){
 
	require_once(AJAX . 'apartmentOption.php');
	
} elseif($id == 7) {
 
	require_once(AJAX . 'houseOption.php');
	
} elseif($id == 8) {
 
	require_once(AJAX . 'shopOption.php');
	
} elseif($id == 9) {
 
	require_once(AJAX . 'landOption.php');
	
} elseif($id == 10) {
 
	require_once(AJAX . 'roomOption.php');
	
} elseif($id == 11) {
 
	require_once(AJAX . 'newPropertyOption.php');
	
} elseif($id == 25) {
	
	require_once(AJAX . 'jobOption.php');
	
} else {
 
    require_once(AJAX . 'priceOption.php');
 
}









}              