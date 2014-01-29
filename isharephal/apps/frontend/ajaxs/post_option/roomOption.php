 <script type="text/javascript">
$(document).ready(function() {
    $(".saleType").change(function() {
        var saleType=$(this).val();
        var dataString = 'saleType='+ saleType;

        $.ajax ({
            type: "POST",
            url: "ajax/ajax_room.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionRoom").html(html);
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
                
               
                
               
            });
            /* ]]> */
        </script>

<div id="spacer"></div>
  	<select name="saleType" class="saleType" id="saleType">
					            <option value="0">-Select-</option>
							    
                                <option value="1">For Rent</option>
                                
                                <option value="2">Wanted To Rent</option>
                                
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
			
                                
								
								</table>
								<div id="spacer"></div> 
                                 
								
								   
                            
                            
    <div class="optionRoom"> </div>    
	<div id="spacer"></div>             