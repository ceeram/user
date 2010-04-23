<?php

class UserGroupsController extends UserAppController {

	var $name = 'UserGroups';

	function index() {
		$this->UserGroup->recursive = 0;
		$this->set('userGroups', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user group'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userGroup', $this->UserGroup->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UserGroup->create();
			if ($this->UserGroup->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user group'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user group'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user group'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserGroup->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user group'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user group'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserGroup->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'user group'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserGroup->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'User group'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'User group'));
		$this->redirect(array('action' => 'index'));
	}

    function showRights($id = null) {
		$userGroup = $this->UserGroup->read(null, $id);
    	$aroNode = array('model' => 'UserGroup', 'foreign_key' => $id);
		$acos = $this->UserGroup->Aco->find('all');
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
    	$this->set(compact('rights', 'userGroup'));

    }
}

?>