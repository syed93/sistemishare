<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
               
                jQuery("#ValidStatus").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
                
                jQuery("#holdType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
               
                
               
            });
            /* ]]> */
        </script>

<?php





if($_POST['saleType']) {
 
	$sale = $_POST['saleType'];

	if($sale == 1) {
echo 'Status:  <select name="status" id="ValidStatus">
							    <option value="0">-Select-</option>
								<option value="bumiputera">Bumiputera</option>
                                <option value="international">International</option>
                                <option value="Others">Others</option>
                                
                            </select>
                      Tenure:  <select name="holdType" id="HoldType">
							    <option value="0">-Select-</option>
								<option value="Freehold">Free Hold</option>
                                <option value="Leasehold">Lease Hold</option>
                                <option value="Others">Others</option>
                                
                            </select>      
                               
                            
                            
								<br/>
                                
                            <div id="spacer"></div>';
echo 'Price: RM<input type="text" name="priceDefault">';		


	} elseif($sale == 2) {



	} 
}
