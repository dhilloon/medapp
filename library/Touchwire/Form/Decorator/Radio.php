<?php
/*
 * Decorator for form inputs
 */
class Touchwire_Form_Decorator_Radio extends Zend_Form_Decorator_Abstract {
	protected $_format = '<label for="%s">
                      <input id="%s" name="%s" type="radio" value="%s"/> %s</label>';

	public function render($content) {
		$element = $this->getElement();
		$name = htmlentities($element->getFullyQualifiedName());
		$label = htmlentities($element->getLabel());
		$id = htmlentities($element->getId());
		$value = htmlentities($element->getValue());

		$markup = '<label for="'.$label.'">';
		$markup .= '<input id="'.$id.'" name="'.$name.'" type="checkbox" value="'.$value.'"/>'. $label.' </label>';
		return $markup;
	}
}
