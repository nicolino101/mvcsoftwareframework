<?php namespace User;

use User\Mapper\UserMapper;
use User\Model\UserModel;
use User\Mapper\AddressMapper;
use User\Model\AddressModel;
use Mvcs\Db\Adapter\PdoAdapter;
use Mvcs\ServiceManager\AbstractServiceManager;

class Module extends AbstractServiceManager 
{
	function __construct()
	{
		if(!defined('LAYOUT_PATH'))
			define('LAYOUT_PATH', __DIR__.'/Layout');
		if(!defined('VIEW_PATH'))
			define('VIEW_PATH', __DIR__.'/View');
	}
	
	function get($key)
	{
		$config = array(
			'localhost' => function() {
				$options = array(
						'driver'    => 'pdo',
						'dsn'       => 'mysql:host=localhost;dbname=mvcs',
						'username'  => 'root',
						'password'  => '123456',
						'driver_options' => array(
								\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
						)
				);
				return new PdoAdapter($options);
		    },
		    
		    'user' => function() {
				$mapper = new UserMapper($this->get('localhost'));
				return new UserModel($mapper);
		    },
		    'address' => function() {
		        $mapper = new \Application\Mapper\AddressMapper($this->get('localhost'));
		        return new AddressModel($mapper);
		    },
		);
	
		return $service = $config[$key]();
	}
}