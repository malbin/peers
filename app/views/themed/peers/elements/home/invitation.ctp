<div id="invitation">
	<div class="wrapper">
		<p class="new-here"><span>Invitation</span><span class="invite"></span></p>
		<?php echo $this->Form->create('SiteInvite', array('controller' => 'SiteInvites', 'action' => 'index', 'onSubmit' => 'return request_invite()', 'name' => 'invite', 'id' => 'site-invite-form'));?>
        <ul>
            <li><?php echo $this->Form->input('name', array('div' => false, 'label' => false,  'placeholder' => 'Name', 'class'=>'validate[required]')); ?></li>
            <li><?php echo $this->Form->input('email', array('div' => false, 'label' => false, 'placeholder' => 'Email', 'class'=>'validate[required,custom[email]]')); ?></li>
            <li><?php echo $this->Form->input('country_id', array('div' => false, 'label' => false, 'class' => 'selectbox')); ?></li>
            <li><?php echo $this->Form->submit('Request', array('div' => false, 'id' => 'invite-submit')); ?></li>
        </ul>
        <div class="tool-tip">
            <div class="text">
                <strong>OOPS!</strong>
            </div>
            <span class="tool-tail"> </span>
        </div>

		<div class="tool-tip" >
            <div class="text" >
                <strong>OOPS!</strong>
            </div>
            <span class="tool-tail"> </span>
        </div>

		<?php echo $this->Form->end();?>
	</div>
</div>
<script type="text/javascript">
	$('#SiteInviteCountryId').selectbox();
</script>
