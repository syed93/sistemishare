 <script type="text/javascript">
$(document).ready(function() {
    $(".saleType").change(function() {
        var saleType=$(this).val();
        var dataString = 'saleType='+ saleType;

        $.ajax ({
            type: "POST",
            url: "ajax/ajax_land.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionLand").html(html);
            } 
        });

     });
 
});
</script> 

<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
                jQuery("#ValidArea").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the required field"
                });
                jQuery("#saleType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select the option"
                });
                jQuery("#ValidSize").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the required field"
                });
               
               
            });
            /* ]]> */
        </script>


<div id="spacer"></div>
  	<select name="saleType" class="saleType">
					            <option value="0">-Select-</option>
							    <option value="1">For Sale</option>
                                <option value="2">Wanted</option>
                                
                                
                            </select>
                            
                            <br/>
							                     
							<div id="spacer"></div>
							 
				Area: <input type="area" name="area" id="ValidArea">  
				Size: <input type="area" name="landSize" id="ValidSize"> Acre
								<div id="spacer"></div> 
                                 
								
								   
                            
                            
    <div class="optionLand"> </div>    
	<div id="spacer"></div>             