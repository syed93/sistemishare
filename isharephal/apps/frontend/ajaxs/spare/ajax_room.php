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
echo '
                                <div id="spacer"></div> 
                                Facilities: <br/>
                                <div id="spacer"></div> 
                                <span>
                                <table>
								
<tr>
	<td>Balcony:</td><td><input type="checkbox" name="Balcony" value="Balcony" /></td>
	<td>Car Parks:</td><td><input type="checkbox" name="carParks" value="Car Parks" /></td>
	<td>Security Guard:</td><td><input type="checkbox" name="securityGuard" value="Security Guard" /></td>
								</tr>
                                <tr>
	<td>Schools:</td><td><input type="checkbox" name="schools" value="Schools" /></td>
								   <td>Bus Stop:</td><td><input type="checkbox" name="busStop" value="Bus Stop" /></td>
								   <td>Mini Market:</td><td><input type="checkbox" name="markets" value="Mini Market" /></td>
								</tr>
								<tr>
	<td>Swimming Pool:</td><td><input type="checkbox" name="swimmingPool" id="ValidCheckbox_2" value="1" /></td>
	<td>Play Ground:</td><td><input type="checkbox" name="playGround" value="Play Ground" /></td>
	<td>Public Transport:</td><td><input type="checkbox" name="publicTransport" value="Public Transport" /></td>
								</tr>
                                <tr>
	<td>Cable TV:</td><td><input type="checkbox" name="CableTV" value="Cable TV" /></td>
	<td>Air Conditioner:</td><td><input type="checkbox" name="airCond" value="Air Conditioner" /></td>
	<td>Internet Coverage:</td><td><input type="checkbox" name="internetCoverage" value="Internet Coverage" /></td>
								</tr>
								
                                
                                </table>
                                
                            </span>
                            <div id="spacer"></div>';
echo 'Price(Optional): RM<input type="text" name="priceDefault"> Monthly ';		


	} elseif($sale == 2) {

echo 'Max Rent: RM<input type="text" name="price" size="10">';
		

	} 
}
