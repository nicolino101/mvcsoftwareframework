<?php namespace Mvcs\Model;

use Mvcs\Mapper\IMapper;

interface IModel
{
	public function __construct(IMapper $mapper);

	public function create(array $data);
}