<script>
$("document").ready(function() {
	$("ul.jun_thumbnails li").click(function () {
		$("#jun_images").load('{{urlajax}}', {'id': $(this).attr('id')});
		$("ul.jun_thumbnails li").removeClass('jun_highlight');
		$(this).addClass('jun_highlight');
	});
});
</script>
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line"> 
      	<h2>iMall</h2>
      	{{ link_to("imall/index", "iMall", "class": "jun_button jun_button_current") }} 
	  	{{ link_to("imall/add", "New Ad", "class": "jun_button") }} 
	    
	    
	
		<div class="big_box jun_label">	 
			<div class="jun_step">
			    <h3>Step 1</h3><h3>Step 2</h3><h3 class="jun_step_current">Step 3</h3>
			</div>
			<div class="jun_text_on_form">
				<h3>Step 3 of 3: Preview your ad</h3>
				<p>Your ad will be reviewed according to the rules of iMall. After approval, it will be published for a period of 90 days.</p>
				 
			</div>
			  
			{% for post in posts %}   	
				<div class="jun_top_ads">     
					{{ post.category ~ ' > ' ~ post.region ~ ' > ' ~ link_to('ads/' ~ post.title, post.title) }}
					
				</div>
				<table>
				<tr><td>
				
				{% if post.image != '' %}
				    <div id="jun_images">{{image('uploads/imall/images/'~post.image)}}</div>
				{% endif %}
			
				</td></tr>
				<tr><td>
				{{ content()}}
				
				</td></tr>
				<tr><td>
				<div class="jun_post_body">
				    <h4>{{ post.title }}</h4>
				    <pre>{{ post.description }}</pre>
				</div>
				</td></tr>
				</table>
		    {% endfor %}    
        </div>	
	</div>
     
</div>
</div>