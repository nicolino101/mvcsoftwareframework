<?php namespace Mvcs\Controller;

use Mvcs\Controller\IController;
use Mvcs\ServiceManager;
use Mvcs\Request\Request;
use Mvcs\Layout\Layout;

abstract class AbstractController implements IController
{
	protected $sm;
	
	protected $request;
	
	protected $layout;
	
	public function __construct($sm, Request $request)
	{
		$this->sm = $sm;
		
		$this->request = $request;
		
		$this->init();
	}
	
	public function __call($method, $args)
	{
		if($method == 'getParams')
			return $this->request->getParams;
		
		if($method == 'getRequest')
		    return $this->request;
	}
	
	public function setLayout($layoutPath)
	{  
		$layout = Layout::getInstance();
		$this->layout = $layout->setLayoutPath($layoutPath);
	}
	
	public function escape($var)
	{
		// donot affect arrays or objects
		if(is_array($var) || is_object($var))
		{
			return $var;
		}
		
		return htmlentities($var, ENT_QUOTES);
	}
}