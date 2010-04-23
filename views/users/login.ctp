<?php
$session->flash('auth');
echo $this->element('login', array('plugin' => 'user'));
?>