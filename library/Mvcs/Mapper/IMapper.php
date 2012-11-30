<?php namespace Mvcs\Mapper;

use Mvcs\Db\Adapter\IAdapter;
use Mvcs\Model\IModel;

interface IMapper
{
	public function __construct(IAdapter $adapter);

	public function save(IModel $object);

	public function fetchAll($where);

	public function delete($id);
}