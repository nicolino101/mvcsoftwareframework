<?php namespace Mvcs\ServiceManager;

interface IServiceManager
{
	public function get($key);
	
	public function set($key, $val);
}