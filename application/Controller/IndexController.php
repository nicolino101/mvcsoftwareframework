<?php namespace Application\Controller;

use Mvcs\Controller\AbstractController;
use Mvcs\View\ViewModel;

class IndexController extends AbstractController
{
	//init() is called automatically first
	public function init() 
	{
		echo __METHOD__.'<br />';
	}
	
	// indexAction is the default Action called http://mvcs
	public function indexAction()
	{
		echo __METHOD__;
		exit;
	}
	
	// mvcs/application/index/user or with application only
	// http://mvcs/index/user
	public function userAction()
	{
		$model = $this->sm->get('user');

		$result = $model->mapper->fetchAll('talentnum > 145198 LIMIT 10');

		// must use $this->w1->render('w1'); in this view
		$w1 = new ViewModel(array('title' => 'Widget1', 'message' => __METHOD__));
		
		$view = new ViewModel(array(
				'title' => "My Title's",
				'test' =>$this->escape($this->getRequest()->getParam("test")),
				'result' => $result,
				'w1' => $w1
		    )
		);
		
		$view->addJsFile('/js/test.js');
		$view->addCssFile('/css/test.css');
		
		$view->render('user');
	}

	// mvcs/application/index/userinfo or with application only
	// http://mvcs/index/userinfo
	public function userinfoAction()
	{
		$talentnum = 145198;
		
		$model = $this->sm->get('userinfo');

		$result = $model->mapper->fetchAll('talentnum = '.$talentnum);
		
		$view = new ViewModel(array(
				'title' => 'My Title',
				'talentnum' => $this->escape($talentnum),
				'test' => $this->escape($this->getRequest()->getParam('test')),
				'result' => $result
		    )
		);
		$view->render('userinfo');
	}
	
	public function testAction()
	{
		$model = new \Application\Model\UserInfoModel(new \Application\Mapper\UserInfoMapper($this->sm->get('localhost')));
		
		$result = $model->mapper->fetchAll('talentnum =  145198');
		
		var_dump($result);
		
		exit;
	}
}