<?php namespace Mvcs\Request;

use Mvcs\Request\AbstractRequest;

class Request extends AbstractRequest
{
	const DEFAULT_CONTROLLER = 'Application';
	
	protected $module;
	
	protected $controller;
	
	protected $action;
	
	protected $params = [];
	
	protected $post = [];
	
	public function __construct()
	{
		$this->uri = $_SERVER['REQUEST_URI'];
		
		$this->parseUri();
		
		$this->setPostParams();
	}
	
	protected function parseUri()
	{
		$this->uri = trim($this->uri, '/');
		
		$parts = explode('/', $this->uri);
		
		$count = count($parts);
		
		if($count > 2)
		{
			$this->module = ucfirst($parts[0]);
			$this->controller = !empty($parts[1]) ? ucfirst($parts[1]).'Controller' : 'IndexController';
			$this->action = !empty($parts[2]) ? $parts[2].'Action' : 'indexAction';
			
			if($count > 3)
				$this->setGetParams($parts);		
		}
		else
		{
			$this->module = self::DEFAULT_CONTROLLER;
			$this->controller = !empty($parts[0]) ? ucfirst($parts[0]).'Controller' : 'IndexController';
			$this->action = !empty($parts[1]) ? $parts[1].'Action' : 'indexAction';
		}
	}
	
	protected function setPostParams()
	{
		$this->post = $_POST;
	}
	
	protected function setGetParams($parts)
	{
		for($i = 3; $i < count($parts); $i++)
		{	
		    if(isset($parts[$i]) && isset($parts[$i + 1]) && $i % 2 == 1)
		    {
			     $this->params[$parts[$i]] = $parts[$i + 1];
		    }
		}
	}
}