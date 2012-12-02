<?php namespace Talents\Controller;

use Mvcs\Adapter\PdoAdapter;

use Mvcs\Controller\AbstractController;
use Mvcs\View\ViewModel;
use Mvcs\Layout\Layout;

class IndexController extends AbstractController
{
	public $view;
	
	public function init() 
	{
		
	}
	
	public function indexAction()
	{
		$view = new ViewModel(array('title' => __METHOD__));
		$view->render('index');
	}
	
	public function userAction()
	{
		$talentnum = $this->getRequest()->getParam('talentnum');
		
		$model = $this->sm->get('user');
		
		$result = $model->mapper->fetchAll('talentnum >= '.$talentnum, 1);
		
		$userview = new ViewModel(array(		
				'title' => "User Table",
				'talentnum' => $talentnum,
				'result' => $result
		    )
		);
		
		$userview->render('user');
	}

	public function userinfoAction()
	{
		$talentnum = $this->getRequest()->getParam('talentnum');
		
		$model = $this->sm->get('userinfo');
		
		$result = $model->mapper->fetchAll('talentnum >= '.$talentnum, 1);
		
		$userinfoview = new ViewModel(array(		
				'title' => 'UserInfo Table',
				'talentnum' => $talentnum,
				'result' => $result
		    )
		);
		$userinfoview->render('userinfo');
	}
	
	public function userinfo2Action()
	{
		$talentnum = $this->getRequest()->getParam('talentnum');
	
		//$model = $this->sm->get('userinfo2');
		$model = new \Talents\Model\UserInfo2Model(new \Talents\Mapper\UserInfo2Mapper($this->sm->get('localhost')));
	
		$result = $model->mapper->fetchAll('talentnum >= '.$talentnum, 1);
	
		$userinfo2view = new ViewModel(array(	
				'title' => 'UserInfo2 Table',
				'talentnum' => $talentnum,
				'result' => $result
		    )
		);
		$userinfo2view->render('userinfo2');
	}
	
	public function header()
	{
		$headerview = new ViewModel(array(
				'view_path' => LAYOUT_PATH.'/header',
		    )
		);
	}
	
	public function footer()
	{
		//$this->view->headScript()->appendFile('/js/search/search.js');
		$footerview = new View(array(
				'view_path' => LAYOUT_PATH.'/footer',
		    )
		);
	}
	
	public function testAction()
	{
		$model = new \Talents\Model\UserInfoModel(new \Talents\Mapper\UserInfoMapper($this->sm->get('localhost')));
		
		//$result = $model->mapper->fetchAll(array('talentnum = ?' => 6));
		$result = $model->mapper->fetchAll('talentnum =  145198');
		
		var_dump($result);
		
		exit;
	}
}