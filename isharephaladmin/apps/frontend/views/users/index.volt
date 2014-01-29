
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post">
      <h2>iDashboard</h2>
      
      <div class="line"></div>
      
      
      <div class="box">
          <h4>iSetting</h4>
          {{link_to('account/settings', image('img/icons/settings.png'))}}
      </div>
      
      <div class="box space_left">
         <h4>iWallet</h4>
          {{link_to('wallets/index', image('img/icons/iwallet.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>iKomuniti</h4>
          {{link_to('users/view', image('img/icons/user_list.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>iPin</h4>
          {{link_to('epins/index', image('img/icons/epin.png'))}}
      </div>
      
      <div class="box">
          <h4>iMail</h4>
          {{link_to('messages/index', image('img/icons/inbox.png'))}}
      </div>
      
      <div class="box space_left">
         <h4>iTakaful</h4>
          {{link_to('insuran/manage', image('img/icons/calendar.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>iReport</h4>
          {{link_to('reports/index', image('img/icons/report.png'))}}
      </div>
      
      <div class="box space_left">
          <h4>iTree</h4>
          {{link_to('tree/view', image('img/icons/ikomuniti.png'))}}
      </div>
      <div class="box">
          <h4>iPrihatin</h4>
          {{link_to('iprihatin/index', image('img/icons/donation.png'))}}
      </div>
      <div class="box space_left">
          <h4>iPrint</h4>
          {{link_to('prints/index', image('img/icons/print.png'))}}
      </div>
      <div class="box space_left">
          <h4>iMall</h4>
          {{link_to('imall/index', image('img/icons/add_list.png'))}}
      </div>
      
  {{ content() }}
	
  </div>
</div>
</div>