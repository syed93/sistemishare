<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sections Demo</title>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".category").change(function() {
        var category=$(this).val();
        var dataString = 'category='+ category;

        $.ajax ({
            type: "POST",
            url: "ajax_city.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionForm").html(html);
            } 
        });

     });
 
});
</script>



<style>
label
{
font-weight:bold;
padding:10px;
}

.selectParent {
    background-color: #eceff6;
    color: #000;
}
</style>
</head>

<body>

<?php

if(isset($_POST['submit'])) {
	echo $_POST['category'] . '<br/>';
	
	echo $_POST['carMake'] . '<br/>';
	
	echo $_POST['priceDefault'] . 'RM<br/>';
	
	echo $_POST['carYear'] . '<br/>';
}

?>


<div style="margin:80px">

<form action="" method="post">
<label>Category:</label> 


<select name="category" class="category">

                                <option value="0">Selection</option>
                                <option class="selectParent" value=""disabled>-Vechiles-</option>
                                <option value="1">Cars</option>
                                <option value="2">Car Accessory & Parts</option>
                                <option value="3">Motorcycles</option>
                                <option value="4">Other Vechiles</option>
                                <option class="selectParent" value=""disabled>-Properties-</option>
                                <option value="5">Apartements</option>
                                <option value="6">Houses</option>
                                <option value="7">Shops</option>
                                <option value="8">Rooms</option>
                                
                                <option value="9">Lands</option>
                                <option class="selectParent" value=""disabled>-Electronics-</option>
                                <option value="10">Computer & Accessories</option>
                                <option value="11">Tv/Audio/Cameras</option>
                                <option value="12">Phone/Gadgets</option>
                                <option class="selectParent" value=""disabled>-Personal & Hobbies</option>
                                <option value="13">Music/Instrument/Toys</option>
                                <option value="14">Watch/Jewelleries</option>
                                <option value="15">Perfume/Accessories</option>
                                <option value="16">Shoes/Wears</option>
                                <option value="17">Sports/Outdoors</option>
                                <option value="18">Home/Gardens</option>
                                <option class="selectParent" value=""disabled>-Bussiness-</option>
                                <option value="19">Services</option>
                                <option value="20">Jobs</option>
                                <option value="21">Office Equipements</option>
                                <option value="22">Business For Sales</option>
                                <option class="selectParent" value=""disabled>-Others-</option>
                                <option value="23">Foods/Bevereges</option>
                                <option value="24">Travels</option>
                            
                            </select>
                             <br/><br/>

<div class="optionForm" id="hide">

</div>





                            
    
     
     
<input type="submit" name="submit">
</form>   
</div>
</body>
</html>
