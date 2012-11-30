<?php namespace Application\Controller;

use Mvcs\Adapter\PdoAdapter;

use Mvcs\Controller\AbstractController;
use Mvcs\View\View;

class IndexController extends AbstractController
{
	public function init() 
	{
		//echo __METHOD__;
	}
	
	public function indexAction()
	{
		echo __METHOD__;
		exit;
	}
	
	public function userAction()
	{
		$model = $this->sm->get('user');

		$result = $model->mapper->fetchAll('talentnum > 145198 LIMIT 10');

		$view = new View(array(
				'view_path' => 'user',
				'title' => "My Title's",
				'test' => $this->getRequest()->getParam('test'),
				'result' => $result
		    )
		);
	}

	public function userinfoAction()
	{
		$model = $this->sm->get('userinfo');

		$result = $model->mapper->fetchAll('talentnum = 145198');
		
		$view = new View(array(
				'view_path' => 'user',
				'title' => 'My Title',
				'test' => $this->getRequest()->getParam('test'),
				'result' => $result
		    )
		);
	}
	
	public function testAction()
	{
		$model = new \Application\Model\UserInfoModel(new \Application\Mapper\UserInfoMapper($this->sm->get('localhost')));
		
		//$result = $model->mapper->fetchAll(array('talentnum = ?' => 6));
		$result = $model->mapper->fetchAll('talentnum =  145198');
		
		var_dump($result);
		
		/* $result[0]->setTalentnum('1');

		$result[0]->setAddress('42 Grand Street');
		echo $result[0]->getAddress();

		$result[0]->setCity('Amsterdam');
		echo $result[0]->getCity();

		echo $id = $model->mapper->save($result[0]); */
		exit;
	}
}