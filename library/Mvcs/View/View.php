<?php namespace Mvcs\View;

use Mvcs\View\AbstractView;
use Mvcs\Renderer\PhpRenderer;
use Mvcs\Layout\Layout;

class View extends AbstractView
{
	public $vars;
	
	public static $children = [];
	
	public static $hasChildren = 0;
	
	public function __construct($view = null)
	{  
		if($view == 'parent')
		{
			self::$hasChildren = 1;
			return;
		}
		elseif(self::$hasChildren == TRUE)
		{   
			self::$children[]=$view;
			return;
		}
		
		if(self::$hasChildren == 0)
		{
			if($this->isShortName($view['view_path']))
		    {
		        $view['view_path'] = VIEW_PATH.'/'.$view['view_path'];
		    }

		    $this->loadView($view); 
		}
		else 
		{
			$this->loadChildren();
		}
	}
	
	protected function loadView($view)
	{  
		foreach($view as $key=>$val)
		{
			$this->vars[$key] = $val;
		}
		
		$this->renderView();
	}
	
	public function loadChildren()
	{   
		foreach(self::$children as $key=>$view)
		{
			if($this->isShortName($view['view_path']))
			{
				$view['view_path'] = VIEW_PATH.'/'.$view['view_path'];
			}
			$this->vars[$key] = $view;
		}
		//var_dump($this->vars); exit;
		$renderer = new PhpRenderer();
		
		$renderer->renderViews($this->vars);
	}
	
	public function addChildren($views)
	{   
		 $this->loadChildren($this->children);
	}
	
	protected function renderView()
	{
		$renderer = new PhpRenderer();
		
		$renderer->renderViewLayout($this->vars);
	}
	
	public function loadViewsTest()
	{
	    Layout::getInstance()->addChildren($this->views);
	} 
	
	// test for full path
	private function isShortName($view_path)
	{    
		if(stristr($view_path, VIEW_PATH) || stristr($view_path, LAYOUT_PATH))
		{
			return false;
		}
		
		return TRUE;
	}
}