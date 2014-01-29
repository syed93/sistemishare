<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
               
                jQuery("#ValidHoldType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
                
                jQuery("#propertyStatus").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property status"
                });
               jQuery("#ValidSelectionPrice").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select price range"
                });
                
               
            });
            /* ]]> */
        </script>

<?php





if($_POST['saleType']) {
 
	$sale = $_POST['saleType'];

	if($sale == 1) {
echo 'Status:  <select name="propertyStatus" id="propertyStatus">
                                 <option value="0">-Select-</option>
							    <option value="bumiputera">Bumiputera</option>
                                <option value="international">International</option>
                                
                                
                            </select>
                      Tenure:  <select name="holdType" id="ValidHoldType">
                                <option value="0">-Select-</option>
							    <option value="freehold">Free Hold</option>
                                <option value="leasthold">Least Hold</option>
                                
                                
                            </select>      
                               
                            
                            
								<br/>
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
echo 'Price: RM<input type="text" name="priceDefault"> Optional';		


	} elseif($sale == 2) {

echo '<select name="priceRange" id="ValidSelectionPrice">
								<option value="0">-Price Range-</option>
							    <option value="< 100000">< 100000</option>
                                <option value="100000-200000">100000-200000</option>
                                <option value="200000-300000">200000-300000</option>
                                <option value="300000-400000">300000-400000</option>
                                <option value="400000-500000">400000-500000</option>
                                <option value="500000-600000">500000-600000</option>
                                <option value="600000-700000">600000-700000</option>
                                <option value="700000-800000">700000-800000</option>
                                <option value="800000-900000">800000-900000</option>
                                <option value="900000-1million">900000-1million</option>
                                <option value="1 million and above">1 million and above</option>
                                
                            </select>';
		

	} 
}
