<?php namespace Application\Model;

use Mvcs\Model\AbstractModel;
use Mvcs\Mapper\IMapper;

class UserModel extends AbstractModel
{
	protected $talentnum = null;

    protected $oldtalentnum = null;

    protected $talentlogin = null;

    protected $talentpass = null;

    protected $fname = null;

    protected $mname = null;

    protected $lname = null;

    protected $address1 = null;

    protected $address2 = null;

    protected $city = null;

    protected $state = null;

    protected $zip = null;

    protected $email1 = null;

    protected $email2 = null;

    protected $hpage = null;

    protected $dphone = null;

    protected $ephone = null;

    protected $pager = null;

    protected $cell = null;

    protected $des = null;

    protected $date_entered = null;

    protected $sourcenum = null;

    protected $leadnum = null;

    protected $zcard_box = null;

    protected $talent_mode = null;

    protected $cd = null;

    protected $welcome_l_sent = null;

    protected $convnum = null;

    protected $in_collection = null;

    protected $cs_call = null;

    protected $pending = null;

    protected $pin = null;

    protected $package = null;

    protected $missing_sig = null;

    protected $web_cus = null;

    protected $studio_l_sent = null;

    protected $roberta_ass = null;

    protected $wl_ts = null;

    protected $agreement = null;

    protected $exploretalent = null;

    protected $bammodels = null;

    protected $join_status = null;

    protected $x_origin = null;

    protected $ref_id = null;

    protected $sms_provider = null;

    protected $sms_ok = null;

    protected $country = null;

    protected $zip_int = null;

    protected $phone_int = null;

    protected $cell_int = null;

	public function __construct(IMapper $mapper)
	{
		$this->mapper = $mapper;
		
		$this->mapper->model = $this;
		
		$req = new \Mvcs\Request\Request();
		
		echo ($req->getParam('test')); 
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