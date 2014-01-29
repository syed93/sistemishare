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
					
						<option value="0">0</option>
					
						<option value="5000">5 000</option>
					
						<option value="10000">10 000</option>
					
						<option value="20000">20 000</option>
					
						<option value="30000">30 000</option>
					
						<option value="40000">40 000</option>
					
						<option value="50000">50 000</option>
					
						<option value="60000">60 000</option>
					
						<option value="70000">70 000</option>
					
						<option value="80000">80 000</option>
					
						<option value="90000">90 000</option>
					
						<option value="100000">100 000</option>
					
						<option value="110000">110 000</option>
					
						<option value="120000">120 000</option>
					
						<option value="130000">130 000</option>
					
						<option value="140000">140 000</option>
					
						<option value="150000">150 000</option>
					
						<option value="160000">160 000</option>
					
						<option value="170000">170 000</option>
					
						<option value="180000">180 000</option>
					
						<option value="190000">190 000</option>
					
						<option value="200000">200 000</option>
					
						<option value="210000">210 000</option>
					
						<option value="220000">220 000</option>
					
						<option value="230000">230 000</option>
					
						<option value="240000">240 000</option>
					
						<option value="250000">250 000</option>
					
						<option value="260000">260 000</option>
					
						<option value="270000">270 000</option>
					
						<option value="280000">280 000</option>
					
						<option value="290000">290 000</option>
					
						<option value="300000">300 000</option>
					
						<option value="350000">350 000</option>
					
						<option value="400000">400 000</option>
					    
						<option value="500000">500 000</option>
					    
					    <option value="600000">600 000</option>
					    
					    <option value="700000">700 000</option>
				</select></td>
				
				<td><select name="yf" style="width: 120px;">
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
	  <td>	<select name="pt" style="width: 120px;" id="pe" >
					<option value="" >Price to</option>
					
						<option value="5000">5 000</option>
					
						<option value="10000">10 000</option>
					
						<option value="20000">20 000</option>
					
						<option value="30000">30 000</option>
					
						<option value="40000">40 000</option>
					
						<option value="50000">50 000</option>
					
						<option value="60000">60 000</option>
					
						<option value="70000">70 000</option>
					
						<option value="80000">80 000</option>
					
						<option value="90000">90 000</option>
					
						<option value="100000">100 000</option>
					
						<option value="110000">110 000</option>
					
						<option value="120000">120 000</option>
					
						<option value="130000">130 000</option>
					
						<option value="140000">140 000</option>
					
						<option value="150000">150 000</option>
					
						<option value="160000">160 000</option>
					
						<option value="170000">170 000</option>
					
						<option value="180000">180 000</option>
					
						<option value="190000">190 000</option>
					
						<option value="200000">200 000</option>
					
						<option value="210000">210 000</option>
					
						<option value="220000">220 000</option>
					
						<option value="230000">230 000</option>
					
						<option value="240000">240 000</option>
					
						<option value="250000">250 000</option>
					
						<option value="260000">260 000</option>
					
						<option value="270000">270 000</option>
					
						<option value="280000">280 000</option>
					
						<option value="290000">290 000</option>
					
						<option value="300000">300 000</option>
					
						<option value="350000">350 000</option>
					
						<option value="500000">500 000</option>
					    
					    <option value="600000">600 000</option>
					    
					    <option value="700000">700 000</option>
					
						<option value="7000000">More than 1million</option>
					
				</select></td><td><select name="yt" style="width: 120px;" id="regdate_re" >
					<option value="" >Reg. year to</option>
					<option value="1" >1981</option>
					<option value="2" >1982</option>
					<option value="3" >1983</option>
					<option value="4" >1984</option>
					<option value="5" >1985</option>
					<option value="6" >1986</option>
					<option value="7" >1987</option>
					<option value="8" >1988</option>
					<option value="9" >1989</option>
					<option value="10" >1990</option>
					<option value="11" >1991</option>
					<option value="12" >1992</option>
					<option value="13" >1993</option>
					<option value="14" >1994</option>
					<option value="15" >1995</option>
					<option value="16" >1996</option>
					<option value="17" >1997</option>
					<option value="18" >1998</option>
					<option value="19" >1999</option>
					<option value="20" >2000</option>
					<option value="21" >2001</option>
					<option value="22" >2002</option>
					<option value="23" >2003</option>
					<option value="24" >2004</option>
					<option value="25" >2005</option>
					<option value="26" >2006</option>
					<option value="27" >2007</option>
					<option value="28" >2008</option>
					<option value="29" >2009</option>
					<option value="30" >2010</option>
					<option value="31" >2011</option>
					<option value="32" >2012</option>
					
				</select></td>
	</tr>		  
    
							
</table>				
				
				

				
				
				
			
  </div>





  


                            