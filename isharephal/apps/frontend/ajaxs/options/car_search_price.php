<style type="text/css">
.content{
	width:900px;
	margin:0px auto;
}
.demo-ad-top{
	margin:20px 0;
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
   }  
   else if(value=='2') {
   $("#forSale").hide();
    
   }  
   else if(value=='3') {
   $("#forSale").hide();
    
   }  
   else if(value=='4') {
   $("#forSale").hide();
    
   } 

  });
  $("#all").show();
  $("#forSale").show();
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
	?>/>All
    
   
      <input type="radio" name="type" value="1" id="type_1"   <?php 
    if(isset($_GET['type'])) {
		if($_GET['type'] == '1') {
			echo 'checked="checked"';
		}
	}
	?>/>For Sale
 
       <input type="radio" name="type" value="2" id="type_2"   <?php 
    if(isset($_GET['type'])) {
		if($_GET['type'] == '2') {
			echo 'checked="checked"';
		}
	}
	?>/>For Rent
      
      <input type="radio" name="type" value="3" id="type_3"   <?php 
    if(isset($_GET['type'])) {
		if($_GET['type'] == '3') {
			echo 'checked="checked"';
		}
	}
	?>/>Wanted
    
   
      <input type="radio" name="type" value="4" id="type_4"   <?php 
    if(isset($_GET['type'])) {
		if($_GET['type'] == '4') {
			echo 'checked="checked"';
		}
	}
	?>/>Wanted To Rent
      
</span> 
 
  
  
  
  <div id="all">

  </div>
 
<div id="forSale" class="blueSearch">
	<table class="tableCenter">
	<tr>
	    <td><select name="pf" style="width: 120px;" id="ps_0" >
					<option value="" >Price from</option>
					
						<option <?php getSelect($_GET['pf'], 1);?> value="1">0</option>
					
						<option <?php getSelect($_GET['pf'], 5000);?> value="5000">5 000</option>
					
						<option <?php getSelect($_GET['pf'], 10000);?> value="10000">10 000</option>
					
						<option <?php getSelect($_GET['pf'], 20000);?> value="20000">20 000</option>
					
						<option <?php getSelect($_GET['pf'], 30000);?> value="30000">30 000</option>
					
						<option <?php getSelect($_GET['pf'], 40000);?> value="40000">40 000</option>
					
						<option <?php getSelect($_GET['pf'], 50000);?> value="50000">50 000</option>
					
						<option <?php getSelect($_GET['pf'], 60000);?> value="60000">60 000</option>
					
						<option <?php getSelect($_GET['pf'], 70000);?> value="70000">70 000</option>
					
						<option <?php getSelect($_GET['pf'], 80000);?> value="80000">80 000</option>
					
						<option <?php getSelect($_GET['pf'], 90000);?> value="90000">90 000</option>
					
						<option <?php getSelect($_GET['pf'], 100000);?> value="100000">100 000</option>
					
						<option <?php getSelect($_GET['pf'], 110000);?> value="110000">110 000</option>
					
						<option <?php getSelect($_GET['pf'], 120000);?> value="120000">120 000</option>
					
						<option <?php getSelect($_GET['pf'], 130000);?> value="130000">130 000</option>
					
						<option <?php getSelect($_GET['pf'], 140000);?> value="140000">140 000</option>
					
						<option <?php getSelect($_GET['pf'], 150000);?> value="150000">150 000</option>
					
						<option <?php getSelect($_GET['pf'], 160000);?> value="160000">160 000</option>
					
						<option <?php getSelect($_GET['pf'], 170000);?> value="170000">170 000</option>
					
						<option <?php getSelect($_GET['pf'], 180000);?> value="180000">180 000</option>
					
						<option <?php getSelect($_GET['pf'], 190000);?> value="190000">190 000</option>
					
						<option <?php getSelect($_GET['pf'], 200000);?> value="200000">200 000</option>
					
						<option <?php getSelect($_GET['pf'], 210000);?> value="210000">210 000</option>
					
						<option <?php getSelect($_GET['pf'], 220000);?> value="220000">220 000</option>
					
						<option <?php getSelect($_GET['pf'], 230000);?> value="230000">230 000</option>
					
						<option <?php getSelect($_GET['pf'], 240000);?> value="240000">240 000</option>
					
						<option <?php getSelect($_GET['pf'], 250000);?> value="250000">250 000</option>
					
						<option <?php getSelect($_GET['pf'], 260000);?> value="260000">260 000</option>
					
						<option <?php getSelect($_GET['pf'], 270000);?> value="270000">270 000</option>
					
						<option <?php getSelect($_GET['pf'], 280000);?> value="280000">280 000</option>
					
						<option <?php getSelect($_GET['pf'], 290000);?> value="290000">290 000</option>
					
						<option <?php getSelect($_GET['pf'], 300000);?> value="300000">300 000</option>
					
						<option <?php getSelect($_GET['pf'], 350000);?> value="350000">350 000</option>
					
						<option <?php getSelect($_GET['pf'], 400000);?> value="400000">400 000</option>
					
				</select></td><td>
				<select name="yf" style="width: 120px;" id="regdate_rs" >
					<option value="" >Reg. year from</option>
					<option value="1980" >1980 or older</option>
					<option value="1981" >1981</option>
					<option value="1982" >1982</option>
					<option value="1983" >1983</option>
					<option value="1984" >1984</option>
					<option value="1985" >1985</option>
					<option value="1986" >1986</option>
					<option value="1987" >1987</option>
					<option value="1988" >1988</option>
					<option value="1989" >1989</option>
					<option value="1990" >1990</option>
					<option value="1991" >1991</option>
					<option value="1992" >1992</option>
					<option value="1993" >1993</option>
					<option value="1994" >1994</option>
					<option value="1995" >1995</option>
					<option value="1996" >1996</option>
					<option value="1997" >1997</option>
					<option value="1998" >1998</option>
					<option value="1999" >1999</option>
					<option value="2000" >2000</option>
					<option value="2001" >2001</option>
					<option value="2002" >2002</option>
					<option value="2003" >2003</option>
					<option value="2004" >2004</option>
					<option value="2005" >2005</option>
					<option value="2006" >2006</option>
					<option value="2007" >2007</option>
					<option value="2008" >2008</option>
					<option value="2009" >2009</option>
					<option value="2010" >2010</option>
					<option value="2011" >2011</option>
					<option value="2012" >2012</option>
					
				</select>
			</td>
	</tr>
	
	<tr>
	    <td><select name="pt" style="width: 120px;" id="ps_0" >
					<option value="" >Price To</option>
					
						<option <?php getSelect($_GET['pt'], 5000);?> value="5000">5 000</option>
					
						<option <?php getSelect($_GET['pt'], 10000);?> value="10000">10 000</option>
					
						<option <?php getSelect($_GET['pt'], 20000);?> value="20000">20 000</option>
					
						<option <?php getSelect($_GET['pt'], 30000);?> value="30000">30 000</option>
					
						<option <?php getSelect($_GET['pt'], 40000);?> value="40000">40 000</option>
					
						<option <?php getSelect($_GET['pt'], 50000);?> value="50000">50 000</option>
					
						<option <?php getSelect($_GET['pt'], 60000);?> value="60000">60 000</option>
					
						<option <?php getSelect($_GET['pt'], 70000);?> value="70000">70 000</option>
					
						<option <?php getSelect($_GET['pt'], 80000);?> value="80000">80 000</option>
					
						<option <?php getSelect($_GET['pt'], 90000);?> value="90000">90 000</option>
					
						<option <?php getSelect($_GET['pt'], 100000);?> value="100000">100 000</option>
					
						<option <?php getSelect($_GET['pt'], 110000);?> value="110000">110 000</option>
					
						<option <?php getSelect($_GET['pt'], 120000);?> value="120000">120 000</option>
					
						<option <?php getSelect($_GET['pt'], 130000);?> value="130000">130 000</option>
					
						<option <?php getSelect($_GET['pt'], 140000);?> value="140000">140 000</option>
					
						<option <?php getSelect($_GET['pt'], 150000);?> value="150000">150 000</option>
					
						<option <?php getSelect($_GET['pt'], 160000);?> value="160000">160 000</option>
					
						<option <?php getSelect($_GET['pt'], 170000);?> value="170000">170 000</option>
					
						<option <?php getSelect($_GET['pt'], 180000);?> value="180000">180 000</option>
					
						<option <?php getSelect($_GET['pt'], 190000);?> value="190000">190 000</option>
					
						<option <?php getSelect($_GET['pt'], 200000);?> value="200000">200 000</option>
					
						<option <?php getSelect($_GET['pt'], 210000);?> value="210000">210 000</option>
					
						<option <?php getSelect($_GET['pt'], 220000);?> value="220000">220 000</option>
					
						<option <?php getSelect($_GET['pt'], 230000);?> value="230000">230 000</option>
					
						<option <?php getSelect($_GET['pt'], 240000);?> value="240000">240 000</option>
					
						<option <?php getSelect($_GET['pt'], 250000);?> value="250000">250 000</option>
					
						<option <?php getSelect($_GET['pt'], 260000);?> value="260000">260 000</option>
					
						<option <?php getSelect($_GET['pt'], 270000);?> value="270000">270 000</option>
					
						<option <?php getSelect($_GET['pt'], 280000);?> value="280000">280 000</option>
					
						<option <?php getSelect($_GET['pt'], 290000);?> value="290000">290 000</option>
					
						<option <?php getSelect($_GET['pt'], 300000);?> value="300000">300 000</option>
					
						<option <?php getSelect($_GET['pt'], 350000);?> value="350000">350 000</option>
					    
					    <option <?php getSelect($_GET['pt'], 500000);?> value="500000">500 000</option>
					    
					    <option <?php getSelect($_GET['pt'], 600000);?> value="600000">600 000</option>
					    
					    <option <?php getSelect($_GET['pt'], 700000);?> value="700000">700 000</option>
					    
						<option <?php getSelect($_GET['pt'], 7000000);?> value="7000000">More than 1Million</option>
						
					
				</select></td><td><select name="yt" style="width: 120px;" id="regdate_re" >
					<option value="" >Reg. year to</option>
					<option value="1981" >1981</option>
					<option value="1982" >1982</option>
					<option value="1983" >1983</option>
					<option value="1984" >1984</option>
					<option value="1985" >1985</option>
					<option value="1986" >1986</option>
					<option value="1987" >1987</option>
					<option value="1988" >1988</option>
					<option value="1989" >1989</option>
					<option value="1990" >1990</option>
					<option value="1991" >1991</option>
					<option value="1992" >1992</option>
					<option value="1993" >1993</option>
					<option value="1994" >1994</option>
					<option value="1995" >1995</option>
					<option value="1996" >1996</option>
					<option value="1997" >1997</option>
					<option value="1998" >1998</option>
					<option value="1999" >1999</option>
					<option value="2000" >2000</option>
					<option value="2001" >2001</option>
					<option value="2002" >2002</option>
					<option value="2003" >2003</option>
					<option value="2004" >2004</option>
					<option value="2005" >2005</option>
					<option value="2006" >2006</option>
					<option value="2007" >2007</option>
					<option value="2008" >2008</option>
					<option value="2009" >2009</option>
					<option value="2010" >2010</option>
					<option value="2011" >2011</option>
					<option value="2012" >2012</option>
					
				</select></td>
	</tr>
			  
 </table>   
							
							
  </div>





  


                            