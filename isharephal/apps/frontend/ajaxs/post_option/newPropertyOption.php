 <script type="text/javascript">
$(document).ready(function() {
    $(".saleType").change(function() {
        var saleType=$(this).val();
        var dataString = 'saleType='+ saleType;

        $.ajax ({
            type: "POST",
            url: "ajax/ajax_new_properties.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionNewProperty").html(html);
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
                                <option value="2">Wanted</option>
                                
                                
                            </select>
							                     
							<div id="spacer"></div>
							 
				<table>
				<tr>
				
				   <td>Area:</td><td><input type="text" name="propertyArea" id="propertyArea"></td>
				   <td>Property Type:</td><td><select name="apartmentType" id="propertyType">
                                <option value="0">-Property Type-</option>
								<option value="Apartment/Flat">Apartment/Flat</option>
								<option value="Bungalow/Villa/Cluster Houses">Bungalow/Villa/Cluster Houses</option>
                                <option value="Condo/Service Residence/Penthouse/Townhouse">Condo/Service Residence/Penthouse/Townhouse</option>    <option value="Double Storey">Double Storey</option>
                                <option value="Single Storey">Single Storey</option>
                                <option value="Two & Half Storey">Two & Half Storey</option>
                                <option value="Triple Storey">Triple Storey</option>
                                <option value="Semi Detached">Semi Detached</option>
                                <option value="Office Space">Office Space</option>
                                <option value="Shop Lot">Shop Lot</option>
                                <option value="Warehouse/Factory">Warehouse/Factory</option>
                                
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
                                <option value="9">9</option>
                                <option value="10">10</option>
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
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                
                            </select>
							</td><td>Total Unit/Lot:</td><td><input type="text" name="totalUnit"</td>
								</tr>
								
								</table>
								<div id="spacer"></div> 
                                 
								
								   
                            
                            
    <div class="optionNewProperty"> </div>    
	<div id="spacer"></div>             