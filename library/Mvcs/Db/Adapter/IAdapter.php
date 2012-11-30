<?php namespace Mvcs\Db\Adapter;

interface IAdapter
{
    public function setDbTable($table);
    
    public function getDbTable();
}