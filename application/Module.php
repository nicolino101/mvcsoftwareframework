<?php namespace Application;

use Application\Mapper\UserMapper;
use Application\Model\UserModel;
use Application\Mapper\AddressMapper;
use Application\Model\AddressModel;
use Mvcs\Db\Adapter\PdoAdapter;
use Mvcs\ServiceManager\AbstractServiceManager;

class Module extends AbstractServiceManager 
{
	function __construct()
	{
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
		    'exploretalent' => function() {
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
				return new \User\Model\UserModel($mapper);
		    },
		    'address' => function() {
		        $mapper = new AddressMapper($this->get('localhost'));
		        return new \User\Model\AddressModel($mapper);
		    },
		);
	
		return $service = $config[$key]();
	}
}