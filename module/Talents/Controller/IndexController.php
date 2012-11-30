<?php namespace Talents\Controller;

use Mvcs\Adapter\PdoAdapter;

use Mvcs\Controller\AbstractController;
use Mvcs\View\View;
use Mvcs\Layout\Layout;

class IndexController extends AbstractController
{
	public $view;
	
	public function init() 
	{
		$this->setLayout(LAYOUT_PATH.'/default.php');
		
		//var_dump($this); exit;
		//$this->view->headScript()->appendFile('/js/search/search.js');
		
	}
	
	public function indexAction()
	{
		$this->header();
		$this->userAction(); 
		$this->userinfoAction();
		$this->userinfo2Action();
		$this->footer();
	}
	
	public function userAction()
	{
		$talentnum = $this->getRequest()->getParam('talentnum');
		
		$model = $this->sm->get('user');
		
		$result = $model->mapper->fetchAll('talentnum >= '.$talentnum, 1);
		
		//$view = new View('parent');
		
		$userview = new View(array(
				'view_path' => 'user',
				'title' => "User Table",
				//'talentnum' => $id,
				'talentnum' => $talentnum,
				'result' => $result
		    )
		);
	}

	public function userinfoAction()
	{
		$talentnum = $this->getRequest()->getParam('talentnum');
		
		$model = $this->sm->get('userinfo');
		
		$result = $model->mapper->fetchAll('talentnum >= '.$talentnum, 1);
		
		$userinfoview = new View(array(
				'view_path' => 'userinfo',
				'title' => 'UserInfo Table',
				'talentnum' => $talentnum,
				'result' => $result
		    )
		);
		
	}
	
	public function userinfo2Action()
	{
		$talentnum = $this->getRequest()->getParam('talentnum');
	
		//$model = $this->sm->get('userinfo2');
		$model = new \Talents\Model\UserInfo2Model(new \Talents\Mapper\UserInfo2Mapper($this->sm->get('localhost')));
	
		$result = $model->mapper->fetchAll('talentnum >= '.$talentnum, 1);
	
		$userinfo2view = new View(array(
				'view_path' => 'userinfo2',
				'title' => 'UserInfo2 Table',
				'talentnum' => $talentnum,
				'result' => $result
		    )
		);
	}
	
	public function header()
	{
		$headerview = new View(array(
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