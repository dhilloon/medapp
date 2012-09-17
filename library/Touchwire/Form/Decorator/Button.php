<?php
/*
 * Decorator for form inputs
 */
class Touchwire_Form_Decorator_Button extends Zend_Form_Decorator_Abstract {
	protected $_format = '<input id="%s" name="%s" type="submit" value="%s"/>';

	public function render($content) {
		$element = $this->getElement();
		$name = htmlentities($element->getFullyQualifiedName());
		$label = htmlentities($element->getLabel());
		$id = htmlentities($element->getId());
		$value = htmlentities($element->getValue());

		$markup = sprintf($this->_format, $name, $label, $id, $name, $value);
		return $markup;
	}
}
