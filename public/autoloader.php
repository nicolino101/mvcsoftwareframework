<?php


function __autoload($class) 
{
	$aclass =  str_replace('\\', '/', APPLICATION_PATH.'/../'. $class) . '.php';
	
	$mclass =  str_replace('\\', '/', APPLICATION_PATH.'/../module/'. $class) . '.php';
	   
	$lclass =  str_replace('\\', '/', APPLICATION_PATH.'/../library/'. $class) . '.php';
        
	if(file_exists($aclass))
	{
	    require_once($aclass);
	}
	if(file_exists($mclass))
	{
		require_once($mclass);
	}
	if(file_exists($lclass))
	{
	    require_once($lclass);
	}
}