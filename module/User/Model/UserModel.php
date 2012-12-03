<?php namespace User\Model;

use Mvcs\Model\AbstractModel;
use Mvcs\Mapper\IMapper;

class UserModel extends AbstractModel
{
	protected $userid = null;

    protected $username = null;

    protected $password = null;

    protected $firstname = null;

    protected $lastname = null;

    protected $created = null;

    protected $modified = null;
    
    //association table
    protected $address;

	public function __construct(IMapper $mapper)
	{
		$this->mapper = $mapper;
		
		$this->mapper->model = $this;
		
		$req = new \Mvcs\Request\Request();
	}

	public function create(array $data)
	{
		foreach($data as $property=>$val)
		{
			if(property_exists($this, $property))
				$this->$property = $val;
		}

		return $this->mapper->save($this);
	}
}