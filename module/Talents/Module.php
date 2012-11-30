<?php namespace Talents;

use Talents\Mapper\UserMapper;
use Talents\Model\UserModel;
use Talents\Mapper\UserInfoMapper;
use Talents\Model\UserInfoModel;
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
						'dsn'       => 'mysql:host=localhost;dbname=bam',
						'username'  => 'root',
						'password'  => '031866YuP',
						'driver_options' => array(
								\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
						)
				);
				return new PdoAdapter($options);
		    },
		    'exploretalent' => function() {
		        $options = array(
		    		'driver'    => 'pdo',
		    		'dsn'       => 'mysql:host=localhost;dbname=exploretale',
		    		'username'  => 'root',
		    		'password'  => '031866YuP',
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
		    'userinfo' => function() {
		        $mapper = new UserInfoMapper($this->get('localhost'));
		        return new UserInfoModel($mapper);
		    },
		);
	
		return $service = $config[$key]();
	}
}