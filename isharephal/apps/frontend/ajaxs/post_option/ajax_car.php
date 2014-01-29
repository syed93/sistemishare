<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){

                jQuery("#ValidSelectionCarMileage").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select category"
                });
                
                jQuery("#ValidSelectionCarColor").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select category"
                });
                
                jQuery("#ValidSelectionCarYear").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select category"
                });
                
                
            });
            /* ]]> */
        </script>
 <script type="text/javascript" src="plugins/ajaxColorPicker/js/farbtastic.js"></script>
 <link rel="stylesheet" href="plugins/ajaxColorPicker/farbtastic.css" type="text/css" />
 <script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#demo').hide();
    $('#picker').farbtastic('#color');
  });
 </script>
<?php
if($_POST['saleType']) {
 
	$sale = $_POST['saleType'];

	if($sale == 1) {
?>

<table>

<tr>
	<td></td>
	<td><span class="star">*</span><select name="carMileage" id="ValidSelectionCarMileage">
	
                                <option value="">-Mileage-</option>
                                <option value="0-4999">0-4999</option>
                                <option value="5000-9999">5000-9999</option>
                                <option value="10000-14999">10000-14999</option>
                                <option value="15000-19999">5000-9999</option>
                                <option value="20000-49999">20000-49999</option>
                                <option value="50000-99999">50000-99999</option>
                                <option value="100000-149999">100000-149999</option>
                                <option value="150000-199999">150000-199999</option>
                                <option value="200000-249999">200000-249999</option>
                                <option value="250000-299999">250000-299999</option>
                                <option value="300000-499999">300000-499999</option>
                                <option value="500000-599999">500000-599999</option>
                                <option value="More Than 600000">More Than 600000</option>
                                
     </select>                           
	
	</td>
	<td></td>
	<td><span class="star">*</span><select name="carColor" id="ValidSelectionCarColor">
	                             <option value="">-Color Type-</option>
                                <option value="Metallic">Metallic</option>
                                <option value="Solid">Solid</option>
                                <option value="Others">Others</option>
     </select>  </td>
     <td><span class="star">*</span><select name="carYear" id="ValidSelectionCarYear">
                                <option value="">-Reg Year-</option>
							    <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                                <option value="1975">1975</option>
                                <option value="1976">1976</option>
                                <option value="1977">1977</option>
                                <option value="1978">1978</option>
                                <option value="1979">1979</option>
                                <option value="1980">1980</option>
                                <option value="1981">1981</option>
                                <option value="1982">1982</option>
                                <option value="1983">1983</option>
                                <option value="1984">1984</option>
                                <option value="1985">1985</option>
                                <option value="1986">1986</option>
                                <option value="1987">1987</option>
                                <option value="1988">1988</option>
                                <option value="1989">1989</option>
                                <option value="1990">1990</option>
                                
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                                <option value="1998">1998</option>
                                <option value="1999">1999</option>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                            
                            </select></td>
</tr>

</table>


  <div class="form-item"><label for="color">
  Pick color:</label>
  <input type="text" id="color" name="color" value="#2aea1a" />
  </div>
  <div id="picker">
  </div>

  
                            
                   
                            
								<br/>
                                <div id="spacer"></div> 
                                Accessories: <br/>
                                <div id="spacer"></div> 
                                <span>
                                <table>
								
								<tr>
								   <td>CD Player:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_1" value="CD Player" /></td>
								   <td>DVD Player:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="DVD Player" /></td>
								   <td>Air Bag:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="Air Bag" /></td>
								</tr>
                                <tr>
								   <td>Sport Rims:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="Sport Rims" /></td>
								   <td>ABS Breake:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="ABS Breake" /></td>
								   <td>Leather Seats:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="Leather Seats" /></td>
								</tr>
								<tr>
								   <td>GPS Navigation:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="GPS Navigation" /></td>
								   <td>Alarm:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="Alarm" /></td>
								   <td>Central Lock:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="Central Lock" /></td>
								</tr>
                                <tr>
								   <td>Airbag Passenger:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="Airbag Passenger" /></td>
								   <td>Solar Film:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="Solar Film" /></td>
								   <td>Adjustable Steering:</td><td><input type="checkbox" name="carAccesory[]" id="ValidCheckbox_2" value="Adjustable Steering" /></td>
								</tr>
								
                                
                                </table>
                                
                            </span>
                            <div id="spacer"></div>
Price: <input type="text" name="priceDefault">		

<?php
	} elseif($sale == 2) {

?>
Price: <input type="text" name="priceDefault"> / <select name="priceRent">
	                             <option value="">-Select-</option>
                                <option value="Hourly">Hourly</option>
                                <option value="Daily">Daily</option>
                                <option value="Weeklky">Weeklky</option>
                                <option value="Monthly">Monthly</option>
     </select>
		
<?php
	} 
}
?>