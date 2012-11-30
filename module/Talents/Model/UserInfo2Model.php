<?php namespace Talents\Model;

use Mvcs\Model\AbstractModel;
use Mvcs\Mapper\IMapper;

class UserInfo2Model extends AbstractModel
{
	protected $talentnum = null;
    protected $ethnicity = null;
    protected $ethnicity_other = null;
    protected $flang = null;
    protected $slang = null;
    protected $city1 = null;
    protected $city2 = null;
    protected $city3 = null;
    protected $minpay1 = null;
    protected $minpay2 = null;
    protected $minpay3 = null;
    protected $sports = null;
    protected $accents = null;
    protected $musicalinstruments = null;
    protected $dance = null;
    protected $modeltypes = null;
    protected $actortypes = null;
    protected $travel = null;
    protected $acting = null;
    protected $union_sag = null;
    protected $union_aftra = null;
    protected $union_aea = null;
    protected $union_other = null;
    protected $special_skills = null;
    protected $nowork = null;
    protected $agent_name = null;
    protected $agent_site = null;
    protected $extra_link = null;
    protected $singingstyle = null;
    protected $experience = null;
    protected $ethnicity_x = null;
    protected $int_city1 = null;
    protected $int_city2 = null;
    protected $int_city3 = null;
    protected $interest_1 = null;
    protected $interest_2 = null;
    protected $interest_3 = null;
    protected $interest_4 = null;
    protected $interest_5 = null;
    protected $interest_6 = null;
    protected $interest_7 = null;
    protected $interest_8 = null;
    protected $interest_9 = null;
    protected $interest_10 = null;

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