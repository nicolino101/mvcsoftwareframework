<?php namespace mvcs\View;

use Mvcs\View\AbstractView;

class ViewModel extends AbstractView
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
	
	public function addJsFile($file)
	{
		$this->jsFiles .= '<script src="'.$file.'"></script>'."\n";
	}
	
	public function addCssFile($file)
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
	
	public function escape($var)
	{
		return htmlentities($var, ENT_QUOTES);
	}
}