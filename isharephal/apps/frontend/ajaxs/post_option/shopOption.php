 <script type="text/javascript">
$(document).ready(function() {
    $(".saleType").change(function() {
        var saleType=$(this).val();
        var dataString = 'saleType='+ saleType;

        $.ajax ({
            type: "POST",
            url: "ajax/ajax_shop.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionProperty").html(html);
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
                
                jQuery("#propertyType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select the option"
                });
                jQuery("#saleType").validate({
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
                            Property Type:<select name="propertyType" id="propertyType">
                                <option value="0">-Select-</option>
                                <option value="Office Space">Office Space</option>
                                <option value="Shop Lot">Shop Lot</option>
                                <option value="Warehouse / Factory">Warehouse / Factory</option>
                               
                                <option value="Others">Others</option>
                                
                             </select>
							                     
<div id="spacer"></div>
				
			Square Feet:<input type="text" name="width" size="8"> x <input type="text" name="lenght" size="8">
								  
<div id="spacer"></div> 
                                 
								
								   
                            
                            
    <div class="optionProperty"> </div>    
	<div id="spacer"></div>             