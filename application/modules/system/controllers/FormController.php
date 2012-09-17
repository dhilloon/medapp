<?php
/*
 * All ajax form validation
 */
class System_FormController extends Zend_Controller_Action {

	public function init() {
		//disable layout
		$this->_helper->layout->disableLayout();
		$this->getHelper('viewRenderer')->setNoRender(true);
	}

	public function validateAction() {
		//var_dump($this->getRequest()->getControllerName());
        $f = new Touchwire_Form_User();
        $f->isValid($this->_getAllParams());
        $json = $f->getMessages();
        echo Zend_Json::encode($json);
	}

}

