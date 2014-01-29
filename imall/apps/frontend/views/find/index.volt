<script type="text/javascript">
$(document).ready(function() {
    $(".category").change(function() {
        var category=$(this).val();
        var dataString = 'category='+ category;
        $.ajax ({
            type: "POST",
            url: "search_option.php",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".search_option").html(html);
            } 
        });
     });
 }); </script>
<section class="content">

    <div class="search_form">
	
	{{ form('find', 'method': 'get') }}
	    
	    {{ text_field("title", "size": 32) }}
		
			    <select name="category" class="category" id="category">
			    <option value="986750">All Categories</option>
				{% for cat in categories %}
				    <option value="{{ cat.id }}"{%if selected['category'] == cat.id %}selected{% endif %} {%if cat.type == 1 %} 
					class="jun_select_parent" {% endif %}>{{cat.name}}</option>
				{% endfor %}
				</select>
			
				<select name="region" id="selectId">
				{% for region in regions %}
				    
				    <option value="{{ region.id }}">{{region.name}}</option>
					<option value="112"{%if selected['region'] == 112 %}selected{% endif %}>Neighbouring Region</option>
					<option value="102"{%if selected['region'] == 102 %}selected{% endif %}>Entire Malaysia</option>
					<option class="parent_category" value=""Disabled>Choose Regions</option>
						
				{% endfor %}
				
				{% for bottom in bottoms %}
				    <option value="{{ bottom.id }}">{{bottom.name}}</option>
				{% endfor %}
				</select>
			
		        {{ submit_button('Search') }}
		<div class="search_option"></div>	</form>
	
    </div>
</section>
<div class="section-header imall_table">
    {{content()}}
</div>





















