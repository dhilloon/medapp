<?php
// @todo FIXME: Use ACL for security
class User_AsyncController extends Zend_Controller_Action
{
	protected $_doctrine = null;
	protected $_em = null;
	protected $_repo = null;

    public function init()
    {
        //disable layout
    	$this->_helper->layout->disableLayout();
		$this->getHelper('viewRenderer')->setNoRender(true);
		
		//Doctrine
		$this->_doctrine = Zend_Registry::get('doctrine');
		$this->_em = $this->_doctrine->getEntityManager();
		$this->_repo = $this->_em->getRepository('Touchwire\Entity\User');
    }

    public function validateAction()
    {
		echo 'Igot u baby'; exit;
        //
        $f = new Touchwire_Form_User();
        $f->isValid($this->_getAllParams());
        $json = $f->getMessages();
        
        echo Zend_Json::encode($json);
        //var_dump($json);
    }
    
        
    /**
     * UTILITY
     */
    public function getParamID() {
    	$id = $this->getRequest()->getParam('id');
    
    	if ($id == null) {
    		throw new Exception('Id must be provided for this action');
    	}
    	return $id;
    }


}

