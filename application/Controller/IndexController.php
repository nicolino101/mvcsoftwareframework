<?php namespace Application\Controller;

use Mvcs\Controller\AbstractController;
use Mvcs\View\View;
use Mvcs\View\ViewModel;

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

		// must use $this->w1->render('w1'); in view
		$w1 = new ViewModel(array('title' => 'Widget1', 'message' => __METHOD__));
		
		$view = new ViewModel(array(
				'title' => "My Title's",
				'test' => $this->getRequest()->getParam('test'),
				'result' => $result,
				'w1' => $w1
		    )
		);
		
		$view->render('user');
	}

	public function userinfoAction()
	{
		$model = $this->sm->get('userinfo');

		$result = $model->mapper->fetchAll('talentnum = 145198');
		
		$view = new ViewModel(array(
				//'view_path' => 'user',
				'title' => 'My Title',
				'test' => $this->getRequest()->getParam('test'),
				'result' => $result
		    )
		);
		$this->render('user');
	}
	
	public function testAction()
	{
		$model = new \Application\Model\UserInfoModel(new \Application\Mapper\UserInfoMapper($this->sm->get('localhost')));
		
		$result = $model->mapper->fetchAll('talentnum =  145198');
		
		var_dump($result);
		
		exit;
	}
}