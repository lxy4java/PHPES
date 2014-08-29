<?php

class Sort {

	private $json;
	function __construct(Array $sort) {

		$arr = array();
		foreach ($sort as $key => $val) {

			$arr[$key] = array('order' => $val);

		}

		$this -> json = $arr;
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