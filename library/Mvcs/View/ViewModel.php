<?php namespace mvcs\View;

class ViewModel 
{
	protected $jsFiles = null;
	
	protected $cssFiles = null;
	
	public function __construct(array $props = null)
	{
		if($props != null)
		{
			foreach($props as $key => $val)
			{
				$this->$key = $val;
			}
		}
	}
	
	public function __set($prop, $value)
	{
		$this->$prop = $value;
	}
	
	public function appendJsFile($file)
	{
		$this->jsFiles .= '<script src="'.$file.'"></script>'."\n";
	}
	
	public function appendCssFile($file)
	{
		$this->cssFiles .= '<link rel="stylesheet" type="text/css" href="'.$file.'">'."\n";
	}
	
	public function render($view = null)
	{
		if($view === null)
		{
			$view = 'index';
		}
	
		require_once VIEW_PATH.'/'.$view.'.php';
	}
}