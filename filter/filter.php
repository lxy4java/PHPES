<?php

class Filter {
	private $json;
	function __construct($obj) {

		$this -> json = $obj;
	}

	function __get($json) {
		if (isset($this -> json)) {

			return ($this -> json);
		} else {
			return (NULL);
		}
	}

}


?>