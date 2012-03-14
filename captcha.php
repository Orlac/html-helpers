<?php
namespace modules\html;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of captcha
 *
 * @author Antonio
 * orlac@rambler.ru
 */
class Captcha extends Ielement {
    //put your code here
    
    public function render( $element = null )
    {
	$captcha = \Captcha::instance();
	$captcha->render();
	$element = \Form::input($this->htmlName(), $this->value, $this->attrs() );
	
	$el = '<div id="field_'.$this->name.'" class="elementForm" >';
	$el .= '<ul class="captcha">';
	$el .= '<li><div class="captcha">'.$captcha.'</div></li>';
	
	$el .= '<li><div class="text">'.$element.'</div></li>';
	$el .= '</ul>';
	$el .= '</div>';
	$el .= '<style>'. file_get_contents(dirname(__FILE__). '/captcha/captcha.css'). '</style>';
	$this->rElement = $el;
    }
    
    public function validate()
    {
	if(parent::validate())
	{
	    if(\Captcha::valid($this->value))
		return true;
	    else
		$this->errors = \I18n::get ( 'don\'t valid anti-spam code' );
	}else
	    return false;
    }
}

?>
