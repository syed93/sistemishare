 <script type="text/javascript">
$(document).ready(function() {
    $(".saleType").change(function() {
        var saleType=$(this).val();
        var dataString = 'saleType='+ saleType;

        $.ajax ({
            type: "POST",
            url: "../views/ajax/ajax_car.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionPrice").html(html);
            } 
        });

     });
 
});
</script> 
<div id="spacer"></div>
  	<select name="saleType" class="saleType">
					            <option value="0">Select</option>
							    <option value="1">For Sale</option>
                                <option value="2">For Rent</option>
                                <option value="3">Wanted</option>
                                <option value="4">Wanted To Rent</option>
                                
                            </select>
							                     
							<div id="spacer"></div>
							 
				<table>
				<tr>
								   <td>Make:</td><td><select name="carMake" id="ValidSelectionMake">
                                <option value="Alpha Romeo">Alpha Romeo</option>
                                <option value="Audi">Audi</option>
								<option value="Austin">Austin</option>
                                <option value="Bufori">Bufori</option>
                                <option value="Changan">Changan</option>
								<option value="Cherry">Cherry</option>
								<option value="Chevrolet">Cheverolate</option>
                                <option value="Citroen">Citroen</option>
                                <option value="Daihatsu">Daihatsu</option>
                                <option value="Datsun">Datsun</option>
                                <option value="Fiat">Fiat</option>
                                <option value="Ford">Ford</option>
                                <option value="Lamborghini">Lamborghini</option>
                                <option value="Mazda">Mazda</option>
                                <option value="Mini">Mini</option>
                                <option value="Perodua">Perodua</option>
                                <option value="Porsche">Porsche</option>
                                <option value="Proton">Proton</option>
                                <option value="Hyundai">Hyundai</option>
                                <option value="Honda">Honda</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Mercedes">Mercedes Benz</option>
                                <option value="Ferrari">Ferrari</option>
                                <option value="Inokom">Inokom</option>
                                
                                <option value="Naza">Naza</option>
                                <option value="Kia">Kia</option>
                                <option value="Jaguar">Jaguar</option>
                                <option value="Land Rover">Land Rover</option>
                                <option value="Lexus">Lexus</option>
                                <option value="Lotus">Lotus</option>
                                <option value="Volvo">Volvo</option>
                                <option value="Mg">Mg</option>
                                <option value="BMW">BMW</option>
                                <option value="Rover">Rover</option>
                                <option value="Hummer">Hummer</option>
                                <option value="Mitsubishi">Mitsubishi</option>
                                <option value="Subaru">Subaru</option>
                                <option value="Saab">Saab</option>
                                <option value="Ssangyong">Ssangyong</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Nissan">Nissan</option>
                                <option value="Opel">Opel</option>
                                <option value="Renault">Renault</option>
                                <option value="Skoda">Skoda</option>
                                <option value="Smart">Smart</option>
                                <option value="Peugeot">Peugeot</option>
                                <option value="Volkswagen">Volkswagon</option>
                                <option value="Others">Others</option>
                                
                            
                            </select>
							
							</td><td>Model:</td><td><input type="text" name="carModel"></td>
								</tr>
                                
                                <tr>
								
								<td>Transmission:</td><td>
								<select name="carTransmission" id="ValidSelectionTransmission">
								<option value="Auto">Auto</option>
                                <option value="Manual">Manual</option>
                                <option value="Others">Others</option></td>
								
								<td>Engine Capacity:</td><td><input type="text" name="engineCapacity">cc</td>
								</select>
								</tr>
								
								</table>
								<div id="spacer"></div> 
                                 
								
								   
                            
                            
    <div class="optionPrice"> </div>    
	<div id="spacer"></div>             