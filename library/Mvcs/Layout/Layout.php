<?php namespace Mvcs\Layout;

use Mvcs\Layout\AbstractLayout;
use Mvcs\Layout\ILayout;
use Mvcs\Renderer\PhpRenderer;


class Layout extends AbstractLayout
{
	protected static $layout;
	
	protected static $layoutPath = false;
	
	protected $viewChildren = [];
	
	public function __construct($layoutPath = null)
	{
		self::$layoutPath = $layoutPath;
	}
	
	public static function getInstance($layoutPath = null)
	{   
		if(isset(self::$layout))
		{ 
		    return self::$layout;
		}
		else 
		{
			return new self($layoutPath);
		}
	}
	
	public function addChildren($views)
	{
		$this->viewChildren []= $views; 
	}
	
	public function getChildren()
	{
		return ($this->viewChildren);
	}
	
	public static function getLayout()
	{
		return static::$layout;
	}
	
	public function setLayoutPath($layoutPath = 'default')
	{
		self::$layout = new self($layoutPath);
		return self::getInstance();
	}
	
	public function getLayoutPath()
	{
		return self::$layoutPath;
	}
	
	public static function render()
	{
		$renderer = new PhpRenderer();
	
		$renderer->setLayout(self::$layout);
	}
}