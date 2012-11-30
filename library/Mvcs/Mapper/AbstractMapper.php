<?php namespace Mvcs\Mapper;

use Mvcs\Mapper\IMapper;
use Mvcs\Db\Adapter\IAdapter;
use Mvcs\Model\IModel;

abstract class AbstractMapper implements IMapper
{
	/**
	 * 
	 * @var IAdapter
	 */
    protected $adapter;
    
    /**
     * 
     * @var Mvcs\Db\Driver\PdoDriver
     */
    protected $db;
    
    /**
     * 
     * @var IModel
     */
    public $model;
    
    /**
     * 
     * @var bool
     */
    public $useDependents = FALSE;
    
	public function __construct(IAdapter $adapter)
	{
	    $this->adapter = $adapter;
	    
	    if(isset($this->dbTable) && $this->dbTable != '')
	    {
	        $this->adapter->setDbTable($this->dbTable);
	    }
	    else 
	    {
	    	print('No dbTable set in '.get_called_class());
	        exit;
	    }
	    
	    $this->db = $this->adapter->getDriver();
	}
	
	public function save(IModel $object)
	{
	    return($model->getId());
	}
	
	public function fetchAll($where, $limit = null)
	{
		$s = $this->db->query($this->dbTable, $where);
		return $this->hydrate($s);
	}
	
	public function delete($id)
	{
	
	}
	
	protected function hydrate($result)
	{
		if(!$result)
		{
			return null;
		}
		
		foreach($result as $row)
		{
			$object = clone $this->model;
	
			$object->setProperty($row);
	
			$objects []= $object;
			
			unset($object); 
		}
	
		return $objects;	 
	}
}