<?php





if($_POST['saleType']) {
 
	$sale = $_POST['saleType'];

	if($sale == 1) {

echo 'Price: RM<input type="text" name="priceDefault">  Year:<input type="text" name="motorcycleYear"><br/>Make:<input type="text" name="motorcycleMake">Model:<input type="text" name="motorcycleModel">';		


	} elseif($sale == 2) {

    echo 'Make:<input type="text" name="motorcycleMake"> Model: <input type="text" name="motorcycleModel">';

	} 
}
