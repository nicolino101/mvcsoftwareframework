<?php namespace Mvcs\Model;

use Mvcs\Model\IModel;

abstract class AbstractModel implements IModel
{
	protected $mapper;
	
	public function __set($property, $val)
	{
		$this->$property = $val;
	}
	
	public function __get($property)
	{
		return $this->$property;
	}
	
	public function __call($method, $args)
	{
		if(preg_match('/^get/', $method, $m))
		{
			$property = strtolower(str_replace($m[0], '', $method));
			if(property_exists($this, $property))
			{
				return $this->$property;
			}
		}
		elseif(preg_match('/^set/', $method, $m))
		{
			$property = strtolower(str_replace($m[0], '', $method));
			$this->$property = $args[0];
		}
		else 
		{
			print($method . ' Trapped in ' . __METHOD__); exit;
		}
	}
	
	public function setProperty(\stdClass $object)
	{
		$array = array();
		 
		$reflection = new \ReflectionObject($object);
		 
		foreach($reflection->getProperties() as $property)
		{
			$property->setAccessible(TRUE);
	
			$key = $property->getName();
			 
			$this->$key = $property->getValue($object);
		}
		 
		return $this;
	}
}