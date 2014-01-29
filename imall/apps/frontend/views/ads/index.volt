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

{% for post in posts %}  
<div class="jun_view_ads">
{{ partial("partials/about_seller") }}
<div class="jun_right line"> 
      	<h2>iMall</h2>
      	{{ link_to("imall/index", "iMall", "class": "jun_button jun_button_current") }} 
	  	{{ link_to("imall/add", "New Ad", "class": "jun_button") }} 
	    
	    
	
	 
			
				<div class="jun_top_ads">     
					<h3>{{ post.category ~ ' > ' ~ post.region ~ ' > ' ~ link_to('view/' ~ post.title, post.title) }}</h3> 
				</div>
				<table>
				<tr><td>
				 {% if post.image != '' %}
				    <div id="jun_images"><img src="{{image_dir}}{{post.image}}"></div>
			     {% endif %}
			
				</td></tr>
				<tr><td>
				{{ content()}} 
				</td></tr>
				<tr><td>
				<div class="jun_post_about">
				    <p><span>Price:</span>{% if post.price != 0 %} RM{{post.price}} {% endif %}</span></p>
				    <p><span>Buy This Item:</span> {{post.name}}</p>
				    <p><span>Name:</span> {{post.name}}</p>
				    <p><span>Phone:</span> {{post.telephone}}</p>
				    <p><span>Address:</span> {{post.address}}</p>
				    <p><span>Region:</span> {{post.id}}</p>
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
		        
        </div>	
	 
     
</div>
</div>
{% endfor %}