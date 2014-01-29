 <script type="text/javascript">
$(document).ready(function() {
    $(".jobOption").change(function() {
        var jobOption=$(this).val();
        var dataString = 'jobOption='+ jobOption;

        $.ajax ({
            type: "POST",
            url: "../views/ajax/ajax_job.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".optionJob").html(html);
            } 
        });

     });
 
});
</script> 


<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
                jQuery("#companyName").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the Required field"
                });
                
                 jQuery("#companyDesc").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the Required field"
                });
                
                jQuery("#jobOption").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select the option"
                });
                jQuery("#jobType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select the option"
                });
                jQuery("#contractType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select the option"
                });
                jQuery("#ValidSelectionHouseType").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
                jQuery("#ValidSelectionRoom").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
                
                jQuery("#ValidSelectionBath").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please select property type"
                });
               
                
               
            });
            /* ]]> */
        </script>



<div id="spacer"></div>
  	<select name="jobType" class="jobOption" id="jobOption">
					            <option value="0">-Select-</option>
							    <option value="1">I am an employer</option>
                                <option value="2">I want a job</option>
                                
                                
                            </select><br/>
                            <div id="spacer"></div>

								<div id="spacer"></div> 
                                 
								
								   
                            
                            
    <div class="optionJob"> </div>    
	<div id="spacer"></div>             