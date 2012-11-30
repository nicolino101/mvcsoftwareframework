<?php namespace Talents\Mapper;

use Mvcs\Mapper\AbstractMapper;

class UserInfo2Mapper extends AbstractMapper
{
    protected $dbTable = 'talentinfo2';
    
    public function fetchAll($where, $limit = null)
    {
    	$stmt = $this->db
    	->select()
    	->columns(array('t2.*'))
    	->from($this->dbTable.' as t2')
    	->where('t2.'.$where)
    	->limit($limit);
    	
    	return $stmt->getResults();
    }
}