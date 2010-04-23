<div class="users showRights">

	<h2><?php __('Rights'); ?></h2>
	
	<h3><?php echo $user['User']['username'] . ', Member of group: '. $user['UserGroup']['name']; ?></h3>

	<?php echo $this->element('rights', array('rights' => $rights)); ?>
</div>
