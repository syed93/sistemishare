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
				{% for cat in cats %}
				    <option value="{{ cat.id }}"{%if selected['category'] == cat.id %}selected{% endif %}>{{cat.name}}</option>
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
<div class="section-header">
    <ul>
	{% for post in posts %}
	<li class="jun_lists">
	    <div class="jun_list_thumb">{% if post.image_name != '' %}{{image('uploads/thumnails/'~post.image_name)}}{% endif %}</div>
		<h3>{{ link_to('ads/' ~ post.title, post.title) }}</h3><p>{{post.reg_name}}</p><p>{{post.cat_name}}</p>
	</li>
	{% endfor %}
	</ul>
	<div class="jun_pagination">
	{{ content()}}
	</div>
</div>





















