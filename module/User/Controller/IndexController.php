<?php namespace User\Controller;

use Mvcs\Adapter\PdoAdapter;

use Mvcs\Controller\AbstractController;
use Mvcs\View\ViewModel;

class IndexController extends AbstractController
{
	public $view;
	
	public function init() 
	{
		
	}
	
	//test: http://mvcs/user/index/index/userid/1
	/**
	 * This shows how to use table relations using objects 
	 */
	public function indexAction()
	{
		$userid = $this->getRequest()->getParam('userid');
		
		$model = $this->sm->get('user');
		
		$result = $model->mapper->fetchAll('userid >= '.$userid);
		
		$addressmodel = $this->sm->get('address');
		
		foreach($result as $key=>$row)
		{		
			$result[$key]->address = $addressmodel->mapper->fetchAll('userid = '.$row->getUserid());
		}
		
		$userview = new ViewModel(array(		
				'title' => $this->escape("User Table"),
				'userid' => $this->escape($userid),
				'result' => $result
		    )
		);
		
		$userview->render('user');
	}
	
	// test: http://mvcs/user/index/user/userid/1
	public function userAction()
	{
		$userid = $this->getRequest()->getParam('userid');
		
		$model = $this->sm->get('user');
		
		$result = $model->mapper->fetchAll('userid >= '.$userid, 1);
		
		$userview = new ViewModel(array(		
				'title' => $this->escape("User Table"),
				'userid' => $this->escape($userid),
				'result' => $result
		    )
		);
		
		$userview->render('user');
	}

	// test: http://mvcs/user/index/address/userid/2
	public function addressAction()
	{
		$userid = $this->getRequest()->getParam('userid');
		
		$model = $this->sm->get('address');
		
		$result = $model->mapper->fetchAll('userid >= '.$userid, 1);
		
		$userinfoview = new ViewModel(array(		
				'title' => $this->escape('Adress Table'),
				'userid' => $this->escape($userid),
				'result' => $result
		    )
		);
		$userinfoview->render('user');
	}
}