<?php namespace Mvcs\Application;

use Mvcs\Controller\AbstractController;

use Mvcs\Request\Request;
use Mvcs\View\View;

class Application 
{
	/**
	 * 
	 * @var IServiceManager
	 */
	public $sm;
	
	/**
	 * fully qualified domain name for the Controller being loaded
	 * @example \Application\Controller\IndexController
	 * @var string 
	 */
	public $fqdnController;
	
	/**
	 * The namespace for the given module
	 * @var string
	 */
	public $module;
	
	/**
	 * 
	 * @var AbstractController
	 */
	public $controller;
	
	/**
	 * 
	 * @var string
	 */
	public $action;
	
	/**
	 * 
	 * @var string
	 */
	public $view;
	
	public function __construct()
	{
		$this->params = $this->getRequest()->getParams();
	}
	
	//@todo add bootstrap and access to bootstrap functions
	public function bootstrap()
	{
		$this->setOptions();
		
		return $this;
	}
	
	//set the properties
	protected function setOptions()
	{
		$parts[1] = $this->module = $this->getRequest()->getModule();
		
		$parts[2] = 'Controller';
		
		$parts[3] = $this->controller = $this->getRequest()->getController();
		
		$this->fqdnController = implode("\\", $parts);
		
		$this->action = $this->getRequest()->getAction();
	}
	
	//load all classes necessary
	public function run()
	{
		$this->loadModule();
	
		$this->loadController();
	
		// this can be overwritten by user in controller
		$this->loadDefaultView();
	}
	
	protected function loadModule()
	{
		$modClass = "\\{$this->module}\\Module";
		$this->sm = new $modClass();
		//$this->module = $module->smConfig($this->action);
	}
	
	public function loadController()
	{
		if(method_exists($this->fqdnController, $this->action))
		{
		    $controller = new $this->fqdnController($this->sm, $this->getRequest());
		
		    $return = call_user_func(array($controller, $this->action));
		    //var_dump($return); 
		} 
		else 
		{
			$this->handleError(__METHOD__); 
			exit;
		}
	}
	
	/**
	 * @todo
	 * Loads the initial view (default)
	 * if indexAction is called - index view is instantiated here
	 */
	protected function loadDefaultView()
	{
		$v = str_replace('Action', '', $this->getRequest()->getAction());
		//$this->view = new View(array('view' => $v));
	}
	
	private function getRequest()
	{
		return new Request();
	}
	
	private function handleError($method)
	{
		print($this->fqdnController.'::'.$this->action.' Does Not Exist!');
		echo '<br />';
		echo 'Module: ';
		echo $this->module;
		echo '<br />';
		echo 'Controller: ';
		echo $this->controller;
		echo '<br />';
		echo 'Action: ';
		echo $this->action;
		echo '<br />';
		echo 'Params: ';
		print_r($this->params);
	}
}