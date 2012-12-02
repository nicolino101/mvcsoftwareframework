<?php namespace Mvcs\Request;

interface IRequest
{
	public function getRequest();
	
	public function getModule();
	
	public function setController($key);
	
	public function getController();
	
	public function setAction($key);
	
	public function getAction();
	
	public function setParam($key, $val);
	
	public function getParams();
	
	public function getParam($key);
}