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
  <div class="jform_post jun_view">
      <h2>iPrihatin Post</h2>
      {{ link_to("iprihatin/index", "iPrihatin", "class": "jun_button") }}
	   
	   
	  
	    <div class="jun_view_iprihatin">
	    <span>{{ content()}}</span>
	    
		{% for iprihatin in iprihatins %}    
	        <h2>{{link_to("iprihatin/view/" ~ iprihatin.slug, iprihatin.title)}}</h2><p>{{get_date}}</p>
	        {% if not (iprihatin.image is empty) %}
			    <img src="{{iprihatin_upload_dir}}{{iprihatin.image}}">
			{% endif %}
			
			<div class="jun_view_iprihatin_bottom">   
				<div class="jun_devide_three">
					<form action="" method="POST">
					{{hidden_field('iprihatin_id', 'value': iprihatin.id)}}
					<p>Sumbangan seikhlas hati <br/>RM {{ text_field('donate_amount', 'placeholder': '0.00')}} <br/>
					{{submit_button('submit', 'value': 'Derma', 'class': 'jun_green_button')}}</p>
					</form>
				</div>
				
				<div class="jun_devide_three">
					
					<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="box_count" data-action="like" 
					data-show-faces="true" data-share="true"></div>
				</div>
				
				<div class="jun_devide_three">
					<p>Baki iWallet: <b>RM{{mywallet}}</b></p>
					
				</div>
			</div>
	        <pre>{{iprihatin.body}}</pre>
		       
		{% endfor %}
		</div> 
	
  </div>
</div>
</div>