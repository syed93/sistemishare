<style type="text/css">
.content{
	width:900px;
	margin:0px auto;
}
.demo-ad-top{
	margin:20px 0 0 0;
}
img{
	border:0px;
}
.blueSearch {
	height: auto;
	width: 100%;
    
}

.radioType {
    color: #333333;

}

#spaceButton {
	height: 5px;
}
.tableCenter {
 	margin-left: auto;
	margin-right: auto;
}
</style>

<script>
$(document).ready(function(){
  $("input[name$='type']").click(function(){
  var value = $(this).val();
  if(value=='0') {
    $("#all").show();
     $("#forSale").hide();
  }
  else if(value=='1') {
   $("#forSale").show();
    $("#all").hide();
   } else {
	$("#forSale").hide();
}

  });
  $("#all").show();
  $("#forSale").hide();
});
</script>	




<div id="spaceButton"></div>
<span class="radioType">
   <input type="radio" name="type" value="0" id="type_0"   <?php 
    if(isset($_GET['type'])) {
		if($_GET['type'] == '0') {
			echo 'checked="checked"';
		}
	} else {
		echo 'checked="checked"';
	}
	?>/>&nbsp;All
    
   
      <input type="radio" name="type" value="1" id="type_1"   <?php 
    if(isset($_GET['type'])) {
		if($_GET['type'] == '1') {
			echo 'checked="checked"';
		}
	}
	?>/>&nbsp;For Sale
 
       <input type="radio" name="type" value="2" id="type_2"   <?php 
    if(isset($_GET['type'])) {
		if($_GET['type'] == '2') {
			echo 'checked="checked"';
		}
	}
	?>/>&nbsp;For Rent
      
      <input type="radio" name="type" value="3" id="type_3"   <?php 
    if(isset($_GET['type'])) {
		if($_GET['type'] == '3') {
			echo 'checked="checked"';
		}
	}
	?>/>&nbsp;Wanted
    
   
      <input type="radio" name="type" value="4" id="type_4"   <?php 
    if(isset($_GET['type'])) {
		if($_GET['type'] == '4') {
			echo 'checked="checked"';
		}
	}
	?>/>&nbsp;Wanted To Rent
      
</span> 
  
 
  
  
  
  <div id="all">

  </div>
 
<div id="forSale" class="blueSearch">
<table class="tableCenter">
 <tr>
 <td><select name="pf" style="width: 120px;" id="ps_3" >
					<option value=""  selected="selected">Price from</option>
					
						<option value="0">0</option>
					
						<option value="100000">100 000</option>
					
						<option value="200000">200 000</option>
					
						<option value="300000">300 000</option>
					
						<option value="400000">400 000</option>
					
						<option value="500000">500 000</option>
					
						<option value="750000">750 000</option>
					
						<option value="1000000">1 000 000</option>
					
						<option value="1250000">1 250 000</option>
					
						<option value="1500000">1 500 000</option>
					
						<option value="1750000">1 750 000</option>
					
						<option value="2000000">2 000 000</option>
					
						<option value="2250000">2 250 000</option>
					
						<option value="2500000">2 500 000</option>
					
						<option value="3000000">3 000 000</option>
					
						<option value="3500000">3 500 000</option>
					
						<option value="4000000">4 000 000</option>
					
						<option value="4500000">4 500 000</option>
					
						<option value="5000000">5 000 000</option>
					
						<option value="5500000">5 500 000</option>
					
						<option value="6000000">6 000 000</option>
					
						<option value="6500000">6 500 000</option>
					
						<option value="7000000">7 000 000</option>
					
				</select></td>	<td><select name="ss" style="width: 120px;" id="ss_2" >
					<option value=""  selected="selected">Min sq.ft.</option>
					
						<option value="0">0</option>
					
						<option value="1000">1000</option>
					
						<option value="2000">2000</option>
					
						<option value="3000">3000</option>
					
						<option value="4000">4000</option>
					
						<option value="5000">5000</option>
					
				</select></td><td><select name="tenure" style="width: 120px;" id="title_type_title" >
						<option value=""  selected="selected">Select Tenure</option>
							
							<option value="1" >Freehold</option><!-- key -->
							<option value="2" >Leasehold</option><!-- key -->
							
					</select></td>
 </tr>	
 
  <tr>
 <td><select name="pt" style="width: 120px;" id="pe" >
					<option value=""  selected="selected">Price to</option>
					
						<option value="100000">100 000</option>
					
						<option value="200000">200 000</option>
					
						<option value="300000">300 000</option>
					
						<option value="400000">400 000</option>
					
						<option value="500000">500 000</option>
					
						<option value="750000">750 000</option>
					
						<option value="1000000">1 000 000</option>
					
						<option value="1250000">1 250 000</option>
					
						<option value="1500000">1 500 000</option>
					
						<option value="1750000">1 750 000</option>
					
						<option value="2000000">2 000 000</option>
					
						<option value="2250000">2 250 000</option>
					
						<option value="2500000">2 500 000</option>
					
						<option value="3000000">3 000 000</option>
					
						<option value="3500000">3 500 000</option>
					
						<option value="4000000">4 000 000</option>
					
						<option value="4500000">4 500 000</option>
					
						<option value="5000000">5 000 000</option>
					
						<option value="5500000">5 500 000</option>
					
						<option value="6000000">6 000 000</option>
					
						<option value="6500000">6 500 000</option>
					
						<option value="7000000">7 000 000</option>
					
						<option value="23">More than 7 000 000</option>
					
				</select>
			</td>	<td><select name="se" style="width: 120px;" id="se_2" >
					<option value=""  selected>Max sq.ft</option>
					
						<option value="1000">1000</option>
					
						<option value="2000">2000</option>
					
						<option value="3000">3000</option>
					
						<option value="4000">4000</option>
					
						<option value="5000">5000</option>
					
						<option value="6">More than 5000</option>
					
				</select></td><td><select name="propertytype" style="width: 120px;" id="other_info_otherInfo" >
						<option value=""  selected="selected">Select Type</option>
							
							<option value="1" >Bumi Lot</option><!-- key -->
							<option value="2" >Non Bumi Lot</option><!-- key -->
							
					</select></td>
 </tr>	  
            
</table>			
				
	
  </div>





  


                            