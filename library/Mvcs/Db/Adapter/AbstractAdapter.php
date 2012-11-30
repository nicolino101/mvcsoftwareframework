<?php namespace Mvcs\Db\Adapter;

use Mvcs\Db\Adapter\IAdapter;

abstract class AbstractAdapter implements IAdapter
{
    public function setDbTable($table)
    {
    	if(!isset($this->dbTable))
    	{
    	    $this->dbTable = $table;
    	}
    }
    
    public function getDbTable()
    {
    	if(isset($this->dbTable))
    	{
    	    return $this->dbTable;
    	}
    }
    
    public function setDriver($driver = null)
    {
    	$this->driver = $driver;
    }
    
    public function getDriver()
    {
    	return $this->driver;
    }
}
