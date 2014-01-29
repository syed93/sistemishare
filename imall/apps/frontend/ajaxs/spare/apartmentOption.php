 <script type="text/javascript">
$(document).ready(function() {
    $(".saleType").change(function() {
        var saleType=$(this).val();
        var dataString = 'saleType='+ saleType;

        $.ajax ({
            type: "POST",
            url: "../views/ajax/ajax_apartment.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionApartment").html(html);
            } 
        });

     });
 
});
</script> 


<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
                jQuery("#propertyArea").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the required field"
                });
                
                jQuery("#saleType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select the option"
                });
                jQuery("#propertyType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
                jQuery("#ValidSelectionRoom").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
                
                jQuery("#ValidSelectionBath").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
               
                
               
            });
            /* ]]> */
        </script>

<div id="spacer"></div>
  	<select name="saleType" class="saleType" id="saleType">
					            <option value="0">-Select-</option>
							    <option value="1">For Sale</option>
                                <option value="2">For Rent</option>
                                <option value="3">Wanted</option>
                                <option value="4">Wanted To Rent</option>
                                
                            </select>
							                     
							<div id="spacer"></div>
							 
				<table>
				<tr>
				
				   <td>Area:</td><td><input type="text" name="propertyArea" id="propertyArea"></td>
				   <td>Property Type:</td><td><select name="apartmentType" id="propertyType">
                                <option value="0">-Property Type-</option>
                                <option value="Condo/Service Residence">Condo/Service Residence</option>
                                <option value="Penthouse/Townhouse">Penthouse/Townhouse</option>
                                <option value="Apartment/Flat">Apartment/Flat</option>
                                <option value="Others">Others</option>
                                
                                 </select></td>
				
				</tr>
				<tr>
								   <td>Bed Rooms:</td><td>
								<select name="bedRoom" id="ValidSelectionRoom">
								<option value="0">-Bedrooms-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                 </select>
							
							</td><td>Square Feet:</td><td><input type="text" name="width"size="8"> x <input type="text" name="lenght" size="8"></td>
								</tr>
                                <tr>
								   <td>Bath Room:</td><td>
								<select name="bathRoom" id="ValidSelectionBath">
								<option value="0">-Bathrooms-</option>
							    <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                
                            </select></td><td>Floor:</td><td><input type="text" name="apartmentFloor"</td>
								</tr>
								
								</table>
								<div id="spacer"></div> 
                                 
								
								   
                            
                            
    <div class="optionApartment"> </div>    
	<div id="spacer"></div>             