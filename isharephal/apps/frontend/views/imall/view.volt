<script>
$("document").ready(function() {
	$("ul.jun_thumbnails li").click(function () {
		$("#jun_images").load('{{urlajax}}', {'id': $(this).attr('id')});
		$("ul.jun_thumbnails li").removeClass('jun_highlight');
		$(this).addClass('jun_highlight');
	});
});
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=473945646001405";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line"> 
      	<h2>iMall</h2>
      	{{ link_to("imall/index", "iMall", "class": "jun_button jun_button_current") }} 
	  	{{ link_to("imall/add", "New Ad", "class": "jun_button") }} 
	    
	    
	
		<div class="big_box jun_label">	 
			{% for post in posts %}  
			<div class="jun_text_on_form">
				<h3>Ad Status: 
				{% if post.status == 1 %} 
				    <span class="green"><b>Active</b></span> 
				{% elseif post.status == 0 %} 
					<span class="yellow"><b>Pending</b></span> 
				{% elseif post.status == 2 %}  
					<span class="red"><b>Reject</b></span> 
				{% endif %}</h3>
			</div>
			  
			  	
				<div class="jun_top_ads">     
					<h3>{{ post.category ~ ' > ' ~ post.region ~ ' > ' ~ link_to('view/' ~ post.title, post.title) }}</h3>
					
				</div>
				<table>
				<tr><td>
				
				{% if post.image != '' %}
				    <div id="jun_images">{{image('uploads/imall/images/'~post.image, 'title': post.title, 'alt': post.title)}}</div>
				{% endif %}
			
				</td></tr>
				<tr><td>
				{{ content()}}
				
				</td></tr>
				<tr><td>
				<div class="jun_post_about">
				    <h2>About This Seller</h2> <h2>{% if post.price != 0 %} RM{{post.price}} {% endif %}</h2>
				    <p><span>Name:</span> {{post.name}}</p>
				    <p><span>Phone:</span> {{post.telephone}}</p>
				    <p><span>Address:</span> {{post.address}}</p>
				    <p><span>Region:</span> {{post.region}}</p>
				    <p><span>Date:</span> {{date}}</p>
				</div>
				</td></tr>
				<tr><td>
				<div class="jun_post_body">
				    <h3>{{ post.title }}</h3>
				    <pre>{{ post.description }}</pre>
				</div>
				</td></tr>
				<tr><td>
				<div class="jun_post_addons">
				    <div class="fb-share-button" data-href="{{host}}isharephal/imall/view/{{post.url}}" data-type="button"></div> 
				</div>
				</td></tr>
				</table>
		    {% endfor %}    
        </div>	
	</div>
     
</div>
</div>