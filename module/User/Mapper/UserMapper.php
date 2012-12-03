<?php namespace User\Mapper;

use Mvcs\Mapper\AbstractMapper;

class UserMapper extends AbstractMapper
{
	protected $dbTable = 'user';
	
	// overriding the AbstractMapper
	public function fetchAll($where, $limit = null)
	{
		$stmt = $this->db
		->select()
		->columns(array('u.*'))
		->from($this->dbTable.' as u')
		->where('u.'.$where)
		->limit($limit);
		//var_dump($this->db->getSql());
		return $this->hydrate($stmt->getResults());
	}
	
	public function fetchAllDependents($where, $limit = null)
	{
		$stmt = $this->db
		->select()
		->columns(array('u.userid', 'u.firstname', 'u.lastname', 'a.email'))
		->from($this->dbTable.' as u')
		->leftJoinUsing('address as a', 'userid')
		->where('u.'.$where)
		->limit($limit);
		//var_dump($this->db->getSql()); 
		return $this->hydrate($stmt->getResults());
	}
	
	public function fetchAllDependentsOn($where, $limit = null)
	{
		$stmt = $this->db
		->select()
		->columns(array('u.userid', 'u.firstname', 'u.lastname', 'a.email'))
		->from($this->dbTable.' as u')
		->JoinOn('address as a', 'userid',array('u.userid', 'a.userid'))
		->where('u.'.$where)
		->limit($limit);
		var_dump($this->db->getSql()); exit;
		return $stmt->getResults();
	}
}