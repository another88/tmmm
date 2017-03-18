<?php

/**
 * SmartyVariable
 * 
 * Class that assigns and gets smarty variables during controller execution.
 * 
 * @author a.poteryahin@gmail.com
 * updated: 12/17/08
 */
class SmartyVariable {
	  
	protected $_smarty;
	public $data;
	
	public function __construct(&$smarty){
		$this->_smarty = $smarty;
		$data = array();
	}
	  
	public function __get($member) {
        if (isset($this->data[$member])) {
            return $this->data[$member];
        }
    }

    public function __set($member, $value) {
        $this->data[$member] = $value;
		$this->_smarty->assign($member, $value);
    }
}