<?php
echo $this->Form->create('User', array('url' => array('plugin' => 'user', 'controller' => 'users', 'action' => 'login', 'admin' => false)));
echo $this->Form->inputs(array(
	'username' => array('label' => __('Username', true)),
	'password' => array('label' => __('Password', true)),
	'remember' => array('type' => 'checkbox', 'label' => __('Remember me', true)),
	'legend' => __('Login', true)
));
echo $this->Form->end(__('Login', true));
?>