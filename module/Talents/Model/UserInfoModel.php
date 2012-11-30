<?php namespace Talents\Model;

use Mvcs\Model\AbstractModel;
use Mvcs\Mapper\IMapper;

class UserInfoModel extends AbstractModel
{
	protected $talentnum;
	
	protected $sex;
	
	protected $dobmm;
	
	protected $dobdd;
	
	protected $dobyyyy;
	
	protected $heightfeet;
	
	protected $heightinches;
	
	protected $heightsm;
	
	protected $weightpounds;
	
	protected $weightkilos;
	
	protected $bust;
	
	protected $waist;
	
	protected $hips;
	
	protected $shoes;
	
	protected $shirt;
	
	protected $dress = null;

    protected $sleeve = null;

    protected $haircolor = null;

    protected $hairstyle = null;

    protected $eyecolor = null;

    protected $complexion = null;

    protected $cup = null;

    protected $suit = null;

    protected $build = null;

    protected $h_left = null;

    protected $z_left = null;

    protected $inches = null;

    protected $rating = null;

    protected $twins = null;

    protected $age_range = null;

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