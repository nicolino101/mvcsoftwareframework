<?php namespace Mvcs\ServiceManager;

use Mvcs\ServiceManager\IServiceManager;

abstract class AbstractServiceManager implements IServiceManager
{
	abstract public function get($key);
	
	public function set($key, $val){}
}