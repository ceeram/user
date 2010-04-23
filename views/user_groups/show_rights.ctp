<div class="usergroups showRights">

	<h2><?php __('Rights'); ?></h2>

	<h3><?php echo $userGroup['UserGroup']['name']; ?></h3>

	<?php echo $this->element('rights', array('rights' => $rights)); ?>
</div>
