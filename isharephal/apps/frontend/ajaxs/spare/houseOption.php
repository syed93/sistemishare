 <script type="text/javascript">
$(document).ready(function() {
    $(".saleType").change(function() {
        var saleType=$(this).val();
        var dataString = 'saleType='+ saleType;

        $.ajax ({
            type: "POST",
            url: "../views/ajax/ajax_house.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionHouse").html(html);
            } 
        });

     });
 
});
</script> 


<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
                jQuery("#validArea").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the Required field"
                });
                
                jQuery("#saleType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select the option"
                });
                jQuery("#ValidSelectionHouseType").validate({
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
                                
                            </select><br/>
                            <div id="spacer"></div>
                            
                            Area: <input type="text" name="area" id="validArea" size="30">
                            
                            <div id="spacer"></div>
                            Property Type:<select name="houseType" id="ValidSelectionHouseType">
                                <option value="0">-Select-</option>
                                <option value="Semi Detached">Semi Detached</option>
                                <option value="Bungalow/Villa/Cluster Houses">Bungalow/Villa/Cluster Houses</option>
                                <option value="Single Storey">Single Storey</option>
                                <option value="Double Storey">Double Storey</option>
                                <option value="Triple Storey">Triple Storey</option>
                                <option value="Others">Others</option>
                                
                             </select>
							                     
							<div id="spacer"></div>
							 
				<table>
				<tr>
								   <td>Bed Rooms:</td><td><select name="bedRoom" id="ValidSelectionRoom">
								   <option value="0">-Select-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                             </select>
							
							</td>
							<td>Bath Room:</td><td><select name="bathRoom" id="ValidSelectionBath">
								   <option value="0">-Select-</option>
							    <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                
                            </select>
							</td>
								</tr>
								
								
                                <tr><td>Square Feet:</td><td><input type="text" name="width" size="8"> x <input type="text" name="lenght" size="8">
								   <td>
							
							</td><td></td>
								</tr>
								
								</table>
								<div id="spacer"></div> 
                                 
								
								   
                            
                            
    <div class="optionHouse"> </div>    
	<div id="spacer"></div>             