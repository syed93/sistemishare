
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post">
      <h4>iDashboard</h4>
       
      
      
      <div class="box">
          <h4>iSetting</h4>
          {{link_to('settings/profile', image('img/icons/settings.png'))}}
      </div>
      
      <div class="box space_left">
         <h4>iWallet</h4>
          {{link_to('wallets/index', image('img/icons/wallet.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>iPin</h4>
          {{link_to('epins/index', image('img/icons/epin.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>iMall</h4>
          {{link_to('imall/index', image('img/icons/listing.png'))}}
      </div>
      
      <div class="box">
          <h4>iMail</h4>
          {{link_to('messages/index', image('img/icons/inbox.png'))}}
      </div>
      
      <div class="box space_left {{blink}}">
         <h4>iTakaful</h4>
          {{link_to('wallet/income', image('img/icons/calendar.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>iHistory</h4>
          {{link_to('transactions/histories', image('img/icons/report.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>iKomuniti</h4>
          {{link_to('tree/view', image('img/icon/ikomuniti.png'))}}
      </div>
      
      <div class="box">
          <h4>iPrihatin</h4>
          {{link_to('iprihatin/index', image('img/icons/donation.png'))}}
      </div>
      
      
  {{ content() }}
	
  </div>
</div>
</div>