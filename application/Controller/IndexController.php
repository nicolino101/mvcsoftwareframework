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
	
	//test: http://mvcs/application/index/user
	public function userAction()
	{
		$model = $this->sm->get('user');

		$result = $model->mapper->fetchAll('userid > 0 LIMIT 10');
         
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

	// http://mvcs/index/address
	public function addressAction()
	{
		$userid = 2;
		
		$model = $this->sm->get('address');

		$result = $model->mapper->fetchAll('userid = '.$userid);
		
		$view = new ViewModel(array(
				'title' => 'My Title',
				'userid' => $this->escape($userid),
				'test' => $this->escape($this->getRequest()->getParam('test')),
				'result' => $result
		    )
		);
		$view->render('address');
	}
	
	public function testAction()
	{
		echo __METHOD__;
		exit;
	}
}