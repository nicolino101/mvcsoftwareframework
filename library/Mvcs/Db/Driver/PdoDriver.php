<?php namespace Mvcs\Db\Driver;

class PdoDriver extends AbstractDriver
{
	protected $pdo;
	
	protected $dbTable;
	
	protected $sql = null;
	
	protected $predicate = [];
	
	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	
	public function select()
	{
		$this->predicate['select'] = "SELECT";
		return $this;
	}
	
	public function columns($columns = null)
	{
		if(null === $columns)
		{
			$columns = ' *';
		}
		else
		{
			$columns = ' '.implode(', ', $columns);
		}
		$this->predicate['columns'] = $columns;
		
		return $this;
	}
	
	public function from($table = null)
	{
		if(null != $table)
		{
			$this->table = $table;
		}
		$this->predicate['from'] = ' FROM '.$this->table;
		return $this;
	}
	
	public function where($where = null)
	{
		if(null != $where)
		{
		    $this->predicate['where'] = ' WHERE '.$where;
		}
		return $this;
	}
	
	public function leftJoinOn($table, array $columns)
	{
		$this->predicate['leftJoinOn'] = ' LEFT JOIN '.$table.' ON '.$columns[0].'='.$columns[1].'';
		return $this;
	}
	
	public function leftJoinUsing($table, $column)
	{
		$this->predicate['leftJoinUsing'] = ' LEFT JOIN '.$table.' USING('.$column.')';
		return $this;
	}
	
	public function JoinOn($table, array $columns)
	{
		$this->predicate['joinOn'] = ' JOIN '.$table.' ON '.$columns[0].'='.$columns[1].'';
		return $this;
	}
	
	public function JoinUsing($table, $column)
	{
		$this->predicate['joinUsing'] = ' INNER JOIN '.$table.' USING('.$column.')';
		return $this;
	}
	
	public function limit($limit = null)
	{
		if($limit)
		{
		    $this->predicate['limit'] = ' LIMIT '.$limit;
		}
		return $this;
	}
	
	public function offset($offset)
	{
		$this->predicate['offset'] = ' OFFSET '.$offset;
		return $this;
	}
	
	public function getSql()
	{
		foreach($this->predicate as $key=>$val)
		{
			if(isset($this->predicate[$key]))
			{
				$this->sql .= $val;
			}
		}
		
		return $this->sql; 
	}
	
	public function getStmt()
	{
		return $stmt = $this->pdo->query($this->getSql());
	}
	
	public function getResults()
	{
		$line = __LINE__ + 1;
		if($stmt = $this->pdo->query($this->getSql()))
		{
		    while($row = $stmt->fetchObject())
		    {
			    $results [] = $row;
		    }
			
		    if(empty($results))
		    {
			    return null;
		    }
			
		    return $results;
		}
		else 
		{
			echo 'ERROR!: pdo query is invalid in '.__METHOD__.' on line '.$line;
		}
	}
	
	public function query($dbTable, $where = null)
	{
		if($where) { $where = ' WHERE '.$where; }
		
		$stmt = $this->pdo->query('SELECT * FROM '.$dbTable.$where);
		 
		while($row = $stmt->fetchObject())
		{
			$results [] = $row;
		}
		 
		if(empty($results))
		{
			return null;
		}
		 
		return $results;
	}
}