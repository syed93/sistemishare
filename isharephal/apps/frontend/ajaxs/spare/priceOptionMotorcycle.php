 <script type="text/javascript">
$(document).ready(function() {
    $(".saleType").change(function() {
        var saleType=$(this).val();
        var dataString = 'saleType='+ saleType;

        $.ajax ({
            type: "POST",
            url: "../views/ajax/ajax_price_motorcycle.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionPriceMotorcycle").html(html);
            } 
        });

     });
 
});
</script> 
<div id="spacer"></div>
  	<select name="saleType" class="saleType">
					            <option value="0">Select</option>
							    <option value="1">For Sale</option>
                                <option value="2">Wanted</option>
                                
                                
                            </select>
                          
								<div id="spacer"></div> 
                                 
								
								   
                            
                            
    <div class="optionPriceMotorcycle"> </div>    
	<div id="spacer"></div>             