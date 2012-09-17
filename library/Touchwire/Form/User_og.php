<?php
class Touchwire_Form_User extends Zend_Form {
	protected $_doctrine = null;
	protected $_em = null;
	protected $_repo = null;
	
	protected $_state = null;
	protected $_id = null;
	public function __construct($user_id = null, $state = 'create'){
		parent::__construct();
		//
		$this->_state = $state;
		$this->_id = $user_id;
		//Doctrine
		$this->_doctrine = Zend_Registry::get('doctrine');
		$this->_em = $this->_doctrine->getEntityManager();
		$this->_repo = $this->_em->getRepository('Touchwire\Entity\User');
		
		$this->setName('user');
		$this->setMethod('post');
		//decorators
		$input = new Touchwire_Form_Decorator_Input();
		$password = new Touchwire_Form_Decorator_Password();
		$option = new Touchwire_Form_Decorator_Checkbox();
		$btn = new Touchwire_Form_Decorator_Button();
		
		$id = new Zend_Form_Element_Hidden('id');
		
		$username = new Zend_Form_Element_Text('username');
		$username->setLabel('Enter Username')
			->setAttrib('class', 'span3')
			->setRequired(true)
			->addValidator('StringLength', false, array(4,15))
			->setDecorators(array($input, 'Errors'));
		
		$pswd = new Zend_Form_Element_Password('pswd');
		$pswd->setLabel('Password')
			->setAttrib('class', 'span3')
			->setRequired(true)
			->addValidator('StringLength', false, array(4,15))
			->setDecorators(array($password, 'Errors'));
		
		$pswd2 = new Zend_Form_Element_Password('pswd2');
		$pswd2->setLabel('Repeat Password')
			->setAttrib('class', 'span3')
			->setDecorators(array($password, 'Errors'));
		
		$active = new Zend_Form_Element_Checkbox('active');
		$active->setLabel('Status')
		->setDecorators(array($option, 'Errors'));
		
		$role = new Zend_Form_Element_Text('role');
		$role->setLabel('Role')
			->setRequired(true)
		->setDecorators(array($input, 'Errors'));
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Save')
		->setDecorators(array($btn));
		
		$cancel = new Zend_Form_Element_Reset('cancel');
		$cancel->setLabel('Cancel')
			 ->setDecorators(array($btn));
		
		//add elements
		$this->addElements(array($id, $username, $pswd, $pswd2, $active, $role, $cancel, $submit));
		
		$this->populate();
	}
	
	public function persistData(){
		if($this->_state == 'create'){
			$user= new \Touchwire\Entity\User();
			$this->_repo->saveUser($user, $this->getValues());
			
		}elseif($this->_state == 'update'){
			$user = $this->_repo->findOneBy(array('id' => $this->_id));
			$this->_repo->saveUser($user, $this->getValues());
		}
		$this->_em->flush();
	}
	
	public function populate(){
		if($this->_id != null){
			$user = $this->_repo->findOneBy(array('id' => $this->_id));
			$this->getElement('id')->setValue($user->getId());
			$this->getElement('username')->setValue($user->getUsername());
			$this->getElement('active')->setValue($user->getActive());
			$this->getElement('role')->setValue($user->getRole());
			
			//remove password fields
			$this->removeElement('pswd');
			$this->removeElement('pswd2');
		}
	}
	
}