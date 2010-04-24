<?php
class M4bd15c6a82a84a00bda70fa766eab0dd extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'acos' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
					'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'model' => array('type' => 'string', 'null' => true, 'default' => NULL),
					'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'alias' => array('type' => 'string', 'null' => true, 'default' => NULL),
					'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'aros' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
					'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'model' => array('type' => 'string', 'null' => true, 'default' => NULL),
					'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'alias' => array('type' => 'string', 'null' => true, 'default' => NULL),
					'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'aros_acos' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
					'aro_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
					'aco_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
					'_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
					'_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
					'_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
					'_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'ARO_ACO_KEY' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1),
						'aro_id' => array('column' => 'aro_id', 'unique' => 0),
						'aco_id' => array('column' => 'aco_id', 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM'),
				),
				'userplugin_user_groups' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'userplugin_users' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
					'user_group_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
					'username' => array('type' => 'string', 'null' => false, 'default' => NULL),
					'password' => array('type' => 'string', 'null' => false, 'default' => NULL),
					'email' => array('type' => 'string', 'null' => false, 'default' => NULL),
					'active' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
					'last_login' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'acos', 'aros', 'aros_acos', 'userplugin_user_groups', 'userplugin_users'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		if ($direction == 'up') {
			$Aro = $this->generateModel('Aro');
			$Aro->Behaviors->attach('Tree');
			$Aro->save(array('alias' => 'UserGroups'));
			$Aco = $this->generateModel('Aco');
			$Aco->Behaviors->attach('Tree');
			$Aco->create(array('alias' => 'controllers'));
			$Aco->save();
			$root = $Aco->id;
			$controllers = $this->_getControllerNames();
			foreach ($controllers as $controller) {
				$Aco->create(array('alias' => $controller, 'parent_id' => $root));
				$Aco->save();
			}
			$plugins = App::objects('plugin');
			foreach ($plugins as $plugin) {
				$Aco->create(array('alias' => $plugin, 'parent_id' => $root));
				$Aco->save();
				$pluginId = $Aco->id;
				$controllers = $this->_getControllerNames($plugin);
				foreach ($controllers as $controller) {
					$Aco->create(array('alias' => $controller, 'parent_id' => $pluginId));
					$Aco->save();
				}
			}
		}
		return true;
	}

	private function _getControllerNames($plugin = null) {
		$path = null;
		if ($plugin) {
			$path = App::pluginPath($plugin) . 'controllers' . DS;
		}
		$controllers = App::objects('controller', $path, false);
		$appKey = array_search($plugin . 'App', $controllers);
		if (is_int($appKey)) {
			unset($controllers[$appKey]);
		}
		return $controllers;
	}

}
?>