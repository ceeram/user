<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php printf(__('Register %s', true), __('User', true)); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('password_confirm', array('type' => 'password'));
		echo $this->Form->input('email');
		echo $this->Form->input('email_confirm');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>