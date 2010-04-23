<?php
$session->flash('auth');
echo $this->element('register', array('plugin' => 'user'));
?>