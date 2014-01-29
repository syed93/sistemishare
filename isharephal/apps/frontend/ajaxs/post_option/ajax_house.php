<?php





if($_POST['saleType']) {
 
	$sale = $_POST['saleType'];

	if($sale == 1) {
echo 'Status:  <select name="houseType" id="Status">
                                <option value="">-Select-</option>
							    <option value="Bumi Lot">Bumi Lot</option>
                                <option value="International">International</option>
                                <option value="Others">Others</option>
                                
                            </select>
                      Tenure:  <select name="houseTenure" id="tenure">
                                <option value="">-Select-</option>
							    <option value="Freehold">Freehold</option>
                                <option value="Leasehold">Leasehold</option>
                                <option value="Malay Reserved Land">Malay Reserved Land</option>
                                <option value="Others">Others</option>
                                
                            </select>      
                               
                            
                            
								<br/>
                               
                            <div id="spacer"></div>';
echo 'Price: <input type="text" name="priceDefault">';		


	} elseif($sale == 2) {

echo 'Price: <input type="text" name="priceDefault"> Monthly';
		

	} 
}
