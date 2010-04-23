<?php
class AuclShell extends Shell {

	var $uses = array('User.UserGroup', 'User.User', 'Aro', 'Aco');
	function main() {

	}

	function init() {
		$this->Aro->save(array('alias' => 'UserGroups'));
		$groups = array(
			array('name' => 'admins'),
			array('name' => 'mods'),
			array('name' => 'registered'),
		);
		$this->UserGroup->saveAll($groups);

		App::import('Core', 'Security');
		$users = array(
			array('username' => 'administrator', 'password' => Security::hash('password', null, true), 'active' => 1, 'user_group_id' => 1),
			array('username' => 'administrator2', 'password' => Security::hash('password', null, true), 'active' => 1, 'user_group_id' => 1),
			array('username' => 'moderator', 'password' => Security::hash('password', null, true), 'active' => 1, 'user_group_id' => 2),
			array('username' => 'moderator2', 'password' => Security::hash('password', null, true), 'active' => 1, 'user_group_id' => 2),
			array('username' => 'normaluser', 'password' => Security::hash('password', null, true), 'active' => 1, 'user_group_id' => 3),
			array('username' => 'normaluser2', 'password' => Security::hash('password', null, true), 'active' => 1, 'user_group_id' => 3),
		);
		$this->User->saveAll($users, array('validate' => false));
		$fields = array('aro_id', 'aco_id', '_create', '_read', '_update', '_delete');
		$permissions = array(
			array_combine($fields, array(1,2, 1, 1, 1, 1)),
			array_combine($fields, array(2,1, 1, 1, 1, 1)),
			array_combine($fields, array(6,11, -1, 0, 0, -1)),
			array_combine($fields, array(3,1, 0, 1, 1, 0)),
			array_combine($fields, array(8,11, 0, 1, -1, 0)),
			array_combine($fields, array(4,31, 0,1,0,0)),
			array_combine($fields, array(9,36, 0,1,1,0)),
			array_combine($fields, array(10,37, 0,1,1,0)),
		);
		$this->Aro->Permission->saveAll($permissions);
	}
}
?>