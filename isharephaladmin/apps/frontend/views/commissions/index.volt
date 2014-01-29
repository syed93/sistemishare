
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post">
      <h2>Jun.my Free Ad Services</h2>{{ link_to("users/logout", "Logout") }}
      
      <div class="line"></div>
      
      
      <div class="box">
          <h4>Account Settings</h4>
          {{link_to('account/settings', image('img/icons/settings.png'))}}
      </div>
      
      <div class="box space_left">
         <h4>My E-Wallet</h4>
          {{link_to('wallet/income', image('img/icons/wallet.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>View Users</h4>
          {{link_to('users/view', image('img/icons/user_listing.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>E-Pin</h4>
          {{link_to('epins/index', image('img/icons/epin.png'))}}
      </div>
      
      <div class="box">
          <h4>Messages</h4>
          {{link_to('account/settings', image('img/icons/inbox.png'))}}
      </div>
      
      <div class="box space_left">
         <h4>Management</h4>
          {{link_to('insuran/manage', image('img/icons/calendar.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>Income Reports</h4>
          {{link_to('find/ads', image('img/icons/report.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>Networks</h4>
          {{link_to('tree/view', image('img/icons/downline.png'))}}
      </div>
      
      
  {{ content() }}
	
  </div>
</div>
</div>