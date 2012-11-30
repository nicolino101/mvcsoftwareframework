<?php namespace Mvcs\Request;

use Mvcs\Request\IRequest;

abstract class AbstractRequest implements IRequest
{
	public function getRequest()
	{
		return $this;
	}
	
	public function getModule()
	{
		return $this->module;
	}
	
	public function setController($key)
	{
		$this->controller = $key;
	}
	
	public function getController()
	{
		return $this->controller;
	}
	
	public function setAction($key)
	{
		$this->action = $key;
	}
	
	public function getAction()
	{
		return $this->action;
	}
	
	public function setParam($key, $val)
	{
		$this->params[$key] = $val;
	}
	
	public function getParams()
	{
		if(empty($this->params))
		{
			return '';	
		}
		return $this->params;
	}
	
	public function getParam($key)
	{
		if(empty($this->params[$key]))
		{
			return '';	
		}
		return $this->params[$key];
	}
}