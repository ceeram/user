<?php

class User extends UserAppModel {

	var $displayField = 'username';

	var $actsAs = array('User.Acl' => array('type' => 'both', 'parentClass' => 'UserGroup', 'foreignKey' => 'user_group_id'));

	var $belongsTo = array('User.UserGroup');

	function beforeValidate() {
		if (empty($this->data['User']['user_group_id'])) {
			$userGroup = $this->UserGroup->findByName('registered');
			if ($userGroup) {
				$this->data['User']['user_group_id'] = $userGroup['UserGroup']['id'];
			}
		}
		$this->validate = array(
			'username' => array(
				'is_unique' => array(
					'rule' => array('isUnique'),
					'message' => __('This username is already registered.', true)
				),
				'between' => array(
					'rule' => array('between', 4, 30),
					'message' => __('Your username has to be between 4 and 30 characters.', true)
				)
			),
			'password' => array(
				'compare' => array(
					'rule' => array('compare', array('password_confirm_hash', 'password_confirm')),
					'message' => __('These passwords aren\'t the same.', true)
				),
				'minlength' => array(
					'rule' => array('wrapper', array(array('minLength', 6), array('password_confirm'))),
					'message' => __('The password must be at least 6 characters and should contain at least one digit.', true)
				),
				'onedigit' => array(
					'rule' => array('wrapper', array(array('custom', '/[0-9]+/'), array('password_confirm'))),
					'message' => __('The password must be at least 6 characters and should contain at least one digit.', true)
				)
			),
			'email' => array(
				'email' => array(
					'rule' => array('email'),
					'message' => __('This is not a valid e-mail address.', true),
				),
				'is_unique' => array(
					'rule' => array('wrapper', array(array('isUnique'), array('email_confirm'))),
					'message' => __('This e-mail address is already registered.', true)
				),
				'compare' => array(
					'rule' => array('compare', array('email_confirm')),
					'message' => __('These e-mail addresses aren\'t the same.', true)
				)
			),
			'email_confirm' => array(
				'email' => array(
					'rule' => array('email'),
					'message' => __('This is not a valid e-mail address.', true),
					'last' => true
				)
			),
			'email_for_credentials' => array(
				'email' => array(
					'rule' => array('email'),
					'message' => __('This is not a valid e-mail address.', true),
				),
			)
		);
	}

	function wrapper($value, $options = array(), $rule = array()) {
		$method = $options[0][0];
		$options[0][0] = $this->data[$this->alias][$options[1][0]];

		if (method_exists($this, $method)) {
			$valid = $this->{$method}($value);
		} else {
			$valid = call_user_func_array(array('Validation', $method), $options[0]);
		}

		if (!$valid) {
			foreach($options[1] as $field) {
				$this->invalidate($field, $rule['message']);
			}
		}

		return $valid;
	}

	function compare($value, $options = array(), $rule = array()) {
		$valid = current($value) == $this->data[$this->alias][$options[0]];
		if (!$valid) {
			$this->invalidate(isset($options[1])? $options[1] : $options[0], $rule['message']);
		}
		return $valid;
	}

}
?>