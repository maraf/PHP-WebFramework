<?php

	require_once("BaseTagLib.class.php");

	/**
	 * 
	 *  Class Parameters. 
	 *      
	 *  @author     maraf
	 *  @timestamp  2021-02-28
	 * 
	 */
	class Parameters extends BaseTagLib {

		public function __construct() {
			parent::setTagLibXml("Parameters.xml");
		}

		public function setValue($name, $key = array(), $copyCurrent = "", $addEmpty = false) {
			// parent::request()->set($name, , 'parameters');
		}
		public function setValueFullTag($name, $addEmpty = false) {
		}

		public function setKey($key, $value, $name = "") {
		}

		public function copyCurrent($include = "*", $exclude = "", $name = "") {
		}

		public function getProperty($name) {
			
		}
	}

?>