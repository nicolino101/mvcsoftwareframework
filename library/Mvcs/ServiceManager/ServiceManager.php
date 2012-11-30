<?php namespace Mvcs;

class ServiceManager
{
	function get(array $config)
	{
		return $service = $config[$key]();
	}
}