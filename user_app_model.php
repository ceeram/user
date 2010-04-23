<?php

class UserAppModel extends AppModel {

	var $actsAs = array('User.Acl' => 'both', 'Containable');

	var $tablePrefix = 'userplugin_';
}

?>