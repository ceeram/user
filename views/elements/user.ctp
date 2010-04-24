<?php
$user = $this->Session->read('Auth.User');
if ($user) {
	echo 'Logged in as '. $user['username'];
} else {
	echo $this->Html->link('Log in', array('controller' => 'users', 'action' => 'login', 'plugin' => 'user'));
}

?>
