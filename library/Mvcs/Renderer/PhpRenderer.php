<?php namespace Mvcs\Renderer;

use Mvcs\Layout\Layout;

use Mvcs\Renderer\AbstractRenderer;

class PhpRenderer extends AbstractRenderer
{
	public $vars;
	protected $filename;
	protected static $layout;
	public static $count = 0;
	public $views = [];
	
	public static function setLayout($layout = null)
	{   
		self::$layout = Layout::getInstance();
	}
	
	public function renderViewLayout($view)
	{
		$this->name = $this->getName($view['view_path']);
		
		$this->view[$this->name] = $view;
		
		$this->filename = $view['view_path'].'.php';
		unset($view['view_path']);
		
		$this->content[$this->name] = function()
		{
		    foreach($this->view[$this->name] as $key=>$vars)
		    {	
			    $$key = $vars;
		    }
		    require_once $this->filename;
		}; 
		
		if($layout = Layout::getInstance()->getLayoutPath())
		{  
		    require_once $layout; 
		}
		else 
		{
			echo $this->content[$this->name]();
		}
	}
	
	
	public function renderViews($view)
	{
		$this->n = 0;
		foreach($view as $i=>$v)
		 {
		$this->name [$this->n]= $this->getName($view[$this->n]['view_path']);
	
		$this->view[$this->name[$this->n]] = $view;
	
		$this->filename[$this->n] = $view[$this->n]['view_path'].'.php';
		unset($view[$this->n]['view_path']);
	
		$this->content[$this->name[$this->n]] = function()
		{
			foreach($this->view[$this->name[$this->n]] as $k=>$vars)
			{
				foreach($vars as $key=>$val)
				{
				    
				    $$key = $val;
				}
			}
			require_once $this->filename[$this->n];
		};
	
		if($layout = Layout::getInstance()->getLayoutPath())
		{
			echo $layout;
			require_once $layout;
		}
		else
		{
			echo $this->content[$this->name[$this->n]]();
		}
		$this->n++;
		 }
	}
	
	private function getName($path)
	{
		$parts = explode('/', $path);
		return $name = array_pop($parts);
	}
}