
<div class="section-header">
<div class="jun_left">
<h2>Dear Users</h2>
<p>Your account will be create automatically after your first post. You can logged in and manage your ads next time using email address and password that you entered during first post. Enjoy your free ads, search suppliers, chat with buyers, save favorite sellers and many features.</p>
</div>
<div class="jun_right line">
  <div class="jform_post">
      <h2>Jun.my Free Ad Services</h2>
      <div class="line"></div>
      {{ link_to("users/logout", "Logout") }}
      
      <div class="box">
          <h1>Manage Ads</h1>
          {{ link_to("posts/new", "Post new ad") }}
          {{ link_to("posts/delete", "Delete ad") }}
      </div>
      
      
  {{ content() }}
	
  </div>
</div>
</div>