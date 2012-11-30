<?php namespace Mvcs\Db\Adapter;

use Mvcs\Db\Driver\PdoDriver;

use Mvcs\Db\Adapter\AbstractAdapter;

class PdoAdapter extends AbstractAdapter
{
	protected $pdo;
	
	protected $driver;
	
    public function __construct($config = null)
    {
    	if(null === $config)
    	{
    		//@todo use defaultAdapter
    		echo 'Need to add defaultAdapter'; 
    		exit;	
    	}
    	elseif($config instanceof IAdapter)
    	{
    		$this->getConnectionWithObject($config);
    	}
    	elseif(is_array($config)) 
    	{
    		$this->getConnectionWithArray($config);
    	}
    	else
    	{
    		print('ERROR!: The config for pdo adapter must be an array or a new PDO object<br />');
    		exit;
    	}
    	//var_dump($this->getDbTable());
    	$this->setDriver(new PdoDriver($this->pdo));
    }
    
    protected function getConnectionWithArray(array $config)
    {
    	try {
    	    $this->pdo = new \PDO($config['dsn'], $config['username'], $config['password'], array($config['driver_options']));
    	} catch(\PDOException $e) {
    		print('ERROR!: '.$e->getMessage().'<br />');
    		exit;
    	}
    }
    
    protected function getConnectionWithObject($pdo)
    {
    	try {
    	    $this->pdo = new $pdo();
    	} catch(\PDOException $e) {
    		print('ERROR!: '.$e->getMessage().'<br />');
    		exit;
    	}
    }
}