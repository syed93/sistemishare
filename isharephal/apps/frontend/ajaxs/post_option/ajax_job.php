<?php
if($_POST['jobOption']) {
 
	$sale = $_POST['jobOption'];

	if($sale == 1) {
        require_once('jobEmployer.php');
    } else {
	    require_once('jobSeeker.php');
	}
}
?> 