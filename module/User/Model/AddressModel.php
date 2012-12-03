<?php namespace User\Model;

use Mvcs\Model\AbstractModel;
use Mvcs\Mapper\IMapper;

class AddressModel extends AbstractModel
{
	protected $address_id;
	
	protected $userid;
	
	protected $address;
	
	protected $city;
	
	protected $state;
	
	protected $zipcode;
	
	protected $country;
	
	protected $email;
	
	public function __construct(IMapper $mapper)
	{
		$this->mapper = $mapper;
		
		$this->mapper->model = $this;
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