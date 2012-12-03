<?php namespace User\Mapper;

use Mvcs\Mapper\AbstractMapper;

class AddressMapper extends AbstractMapper
{
    protected $dbTable = 'address';
    
    public function fetchAll($where, $limit = null)
    {
    	$stmt = $this->db
    	->select()
    	->columns(array('t1.*'))
    	->from($this->dbTable.' as t1')
    	//->JoinOn('talentinfo1 as t1',array('t.talentnum', 't1.talentnum'))
    	->where('t1.'.$where)
    	->limit($limit);
    	//var_dump($this->db->getSql()); exit;
    	return $stmt->getResults();
    }
}