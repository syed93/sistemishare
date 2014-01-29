<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){

               
                jQuery("#motorcycleMake").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter make"
                });
                jQuery("#motorcycleModel").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter model"
                });
                jQuery("#year").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter year"
                });
               
            });
            /* ]]> */
        </script>



<table>
<?php
if($_POST['saleType']) {
 
	$sale = $_POST['saleType'];

	if($sale == 1) {

echo '<tr><td>Price: RM<td/><td>
<input type="text" name="priceDefault"> <td/><td>  
Year:<span class="star">*</span><td/><td>
<input type="text" name="motorcycleYear" id="year">
<td/>
</tr><tr><td>Make:<span class="star">*</span><td/><td>
<input type="text" name="motorcycleMake" id="motorcycleMake">
<td/><td> Model:<span class="star">*</span><td/><td>
<input type="text" name="motorcycleModel" id="motorcycleModel"></td></tr>';		


	} elseif($sale == 2) {

    echo '<tr><td>
	Make:<span class="star">*</span><td/><td>
	<input type="text" name="motorcycleMake"> 
	<td/><td> Model: <span class="star">*</span>
	<input type="text" name="motorcycleModel"></td></tr>';

	} 
}
?>
</table>