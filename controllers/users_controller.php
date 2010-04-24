<?php

class UsersController extends UserAppController {

	var $name = 'Users';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->actionMap = array('showRights' => 'read');
		$this->Auth->allow();
	}

	function add() {
		if (!empty($this->data)) {
			$this->data['User']['password_confirm_hash'] = $this->Auth->password($this->data['User']['password_confirm']);
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Acl->allow($this->User, $this->User, array('create', 'read', 'update'));
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'));
				$this->redirect(array('action' => 'index'));
			} else {
				unset($this->data['User']['password']);
				unset($this->data['User']['password_confirm']);
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'));
			}
		}
		$userGroups = $this->User->UserGroup->find('list');
		$this->set(compact('userGroups'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$userGroups = $this->User->UserGroup->find('list');
		$this->set(compact('userGroups'));
	}

	function index() {
		$this->paginate = array(
			'order' => array($this->Auth->fields['username'] => 'ASC'),
			'limit' => 15,
		);

		if (!empty($this->params['named']['keyword'])) {
			$this->paginate['conditions'] = array('User.' . $this->Auth->fields['username'] . ' LIKE ' => '%' . $this->params['named']['keyword'] . '%');
		}

		$this->set('users', $this->paginate());
	}

	function search() {
		$this->redirect(array('action' => 'index', 'keyword' => (!empty($this->data['User']['keyword']) ? $this->data['User']['keyword'] : null)));
	}

	function login() {
		if ($this->Auth->user()) {
			if (!$this->data) {
				$this->Session->setFlash(__('Already logged in', true));
			}
			$this->redirect($this->Auth->redirect());
		}
		unset($this->data['User']['password']);
	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}

	function register() {
		if (!empty($this->data)) {
			$this->data['User']['password_confirm_hash'] = $this->Auth->password($this->data['User']['password_confirm']);
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Acl->allow($this->User, $this->User, array('create', 'read', 'update'));
				$this->Session->setFlash(__('Registration succesfull. An email will be sent to activate your account', true));
				$this->redirect($this->Auth->redirect());
			} else {
				unset($this->data['User']['password']);
				unset($this->data['User']['password_confirm']);
			}
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'user'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'User'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'User'));
		$this->redirect(array('action' => 'index'));
	}

    function showRights($id = null) {
		$user = $this->User->read(null, $id);
    	$aroNode = array('model' => 'User', 'foreign_key' => $id);
    	$acos = $this->User->Aco->find('all');
    	$i=0;
		$actions = array('create', 'read', 'update', 'delete');
    	foreach($acos as $aco) {
    		$acoNode = (!empty($aco['Aco']['alias'])) ? $aco['Aco']['alias'] : array('model' => $aco['Aco']['model'], 'foreign_key' => $aco['Aco']['foreign_key']);
    		$alias = (!empty($aco['Aco']['alias'])) ? $aco['Aco']['alias'] : $aco['Aco']['model'].'.'.$aco['Aco']['foreign_key'];
    		$rights[$i] = array('Aco'=>$alias);
    		foreach($actions as $action){
				$access = 'No';
				if($this->Acl->check($aroNode, $acoNode, $action)) {
					$access = 'Yes';
				}
				$rights[$i][$action] = $access;
	   		}
    	$i++;
    	}
    	$this->set(compact('rights', 'user'));

    }
}

?>