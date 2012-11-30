<?php namespace Talents\Mapper;

use Mvcs\Mapper\AbstractMapper;

class UserMapper extends AbstractMapper
{
	protected $dbTable = 'talentci';
	
	public function fetchAll($where, $limit = null)
	{
		$stmt = $this->db
		->select()
		->columns(array('t.*'))
		->from($this->dbTable.' as t')
		->where('t.'.$where)
		->limit($limit);
		//var_dump($this->db->getSql());
		return $this->hydrate($stmt->getResults());
	}
	
	public function fetchAllDependents($where, $limit = null)
	{
		$stmt = $this->db
		->select()
		->columns(array('t.talentnum', 't.fname', 't.lname', 't1.sex'))
		->from($this->dbTable.' as t')
		->leftJoinUsing('talentinfo1 as t1', 'talentnum')
		->where('t.'.$where)
		->limit($limit);
		//var_dump($this->db->getSql()); 
		return $this->hydrate($stmt->getResults());
	}
	
	public function fetchAllDependentsOn($where, $limit = null)
	{
		$stmt = $this->db
		->select()
		->columns(array('t.talentnum', 't.fname', 't.lname', 't1.sex'))
		->from($this->dbTable.' as t')
		->JoinOn('talentinfo1 as t1',array('t.talentnum', 't1.talentnum'))
		->where('t.'.$where)
		->limit($limit);
		var_dump($this->db->getSql()); exit;
		return $stmt->getResults();
	}
}