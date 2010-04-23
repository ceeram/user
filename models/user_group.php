<?php
class UserGroup extends UserAppModel {

	//var $actsAs = array('Tree');

	var $validate = array(
		'name' => array(
			'required' => array(
				'rule' => 'alphaNumeric',
			),
			'unique' => array(
				'rule' => 'isUnique'
			),
			'minLength' => array(
				'rule' => array('minLength', 4)
			),
		),
	);

	var $hasMany = array('User.User');

}

?>