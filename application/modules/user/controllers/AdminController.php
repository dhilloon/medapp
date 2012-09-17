<?php

class User_AdminController extends Zend_Controller_Action {

	protected $_doctrine = null;
	protected $_em = null;
	protected $_repo = null;

    public function init() {
        //Doctrine
        $this->_doctrine = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrine->getEntityManager();
        $this->_repo = $this->_em->getRepository('Touchwire\Entity\User');
       
    }

	public function indexAction() {
		$this->view->users = $this->_repo->findAll();
		
	}

	public function manageAction() {
		$request = $this->getRequest();
		$state = $this->getParamState();
		//check form state -- refer to util functions below
		if($state == 'update')
			$form = new Touchwire_Form_User($this->getParamId(), $this->getParamState());
		else
			$form = new Touchwire_Form_User();
		
		//check posted & validate form
		if ($request->isPost() &&
				$form->isValid($request->getPost()))
		{
			//process & redirect
			$form->persistData();
			$this->_redirect('/users');
				
		}
		//show form
		$this->view->form = $form;
	}
	public function deleteAction() {
		//diable layout - not needed for this action
		$this->_helper->layout->disableLayout();
		$this->getHelper('viewRenderer')->setNoRender(true);
		//delete
		$this->_repo->removeUser($this->getParamID());
        $this->_em->flush();
        
        $this->_redirect('/users');
	}	
	
	//utility functions
	public function getParamID() {
		$id = $this->getRequest()->getParam('id');
		if ($id == null)
			throw new Exception('Id must be provided for this action');
		return $id;
	}
	
	public function getParamState() {
		$state = $this->getRequest()->getParam('state');
		if ($state == null)
			throw new Exception('Id must be provided for this action');
		return $state;
	}

}

