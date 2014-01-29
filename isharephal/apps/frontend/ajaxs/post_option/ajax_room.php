<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
               
                jQuery("#ValidHoldType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
                
                jQuery("#ApartmentStatus").validate({
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
?>
	
	Square Feet:</td><td><input type="text" name="width"size="8"> x <input type="text" name="lenght" size="8"><br/>
								  
   
                                <div id="spacer"></div> 
                                Facilities: <br/>
                                 
                                <span>
                                <table>
								
<tr>
	<td>Balcony:</td><td><input type="checkbox" name="facilities[]" value="Balcony" /></td>
	<td>Car Parks:</td><td><input type="checkbox" name="facilities[]" value="Car Parks" /></td>
	<td>Security Guard:</td><td><input type="checkbox" name="facilities[]" value="Security Guard" /></td>
								</tr>
                                <tr>
	<td>Schools:</td><td><input type="checkbox" name="facilities[]" value="Schools" /></td>
								   <td>Bus Stop:</td><td><input type="checkbox" name="facilities[]" value="Bus Stop" /></td>
								   <td>Mini Market:</td><td><input type="checkbox" name="facilities[]" value="Mini Market" /></td>
								</tr>
								<tr>
	<td>Swimming Pool:</td><td><input type="checkbox" name="facilities[]" id="ValidCheckbox_2" value="Swimming Pool" /></td>
	<td>Play Ground:</td><td><input type="checkbox" name="facilities[]" value="Play Ground" /></td>
	<td>Public Transport:</td><td><input type="checkbox" name="facilities[]" value="Public Transport" /></td>
								</tr>
                                <tr>
	<td>Cable TV:</td><td><input type="checkbox" name="facilities[]" value="Cable TV" /></td>
	<td>Air Conditioner:</td><td><input type="checkbox" name="facilities[]" value="Air Conditioner" /></td>
	<td>Internet Coverage:</td><td><input type="checkbox" name="facilities[]" value="Internet Coverage" /></td>
								</tr>
								
                                
                                </table>
                                
                            </span>
                            <div id="spacer"></div>
Price(Optional): RM<input type="text" name="priceDefault"> Monthly 		

<?php
	} elseif($sale == 2) {
?>
Max Rent: RM<input type="text" name="price" size="10">
<?php		

	} 
}
?>