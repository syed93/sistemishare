<div class="jun_view_ads">
    {% for post in posts %}	
	    <div class="jun_left">
	        <h2>About This Seller<h2>
	        <img src="/ci/uploads/profiles/{{post.profile_img}}">
	        <ul class="jun_left_menu">
	            <li><img src="/ci/img/icons/home.png">{{link_to('', 'Home Page')}}</li>
	            <li><img src="/ci/img/icons/user.png">{{link_to('users/' ~ post.user_name, post.biz_name)}}</li>
	            <li><img src="/ci/img/icons/phone.png">{{post.phone}}</li>
	            <li><img src="/ci/img/icons/mail.png">{{post.user_email}}</li>
				<li><img src="/ci/img/icons/pin.png">{{post.city}}</li>
				<li><img src="/ci/img/icons/date.png">Join Since {{since}}</li>
	            <li><img src="/ci/img/icons/disckette.png">{{link_to('save/' ~ post.id, 'Save This Ad')}}</li>
	            
	        </ul>
	    </div>
	    <div class="jun_right">		
			<div class="jun_top_ads">     
				{{ post.cat_name ~ ' > ' ~ post.reg_name ~ ' > ' ~ link_to('ads/' ~ post.title, post.title) }}
				<h2>{{ post.title }}</h2>
			</div>
			<table>
			<tr><td>
			
			{% if post.image_name != '' %}
			    <div id="jun_images"><img src="/ci/uploads/posts/{{post.image_name}}"></div>
			{% endif %}
		
			</td></tr>
			<tr><td>
			{{ content()}}
			</td></tr>
			<tr><td>
			<div class="postBody">
			    <pre><p>{{ post.description }}</p></pre>
			</div>
			</td></tr>
			</table>
		
        </div>	
	{% endfor %}
</div>





















