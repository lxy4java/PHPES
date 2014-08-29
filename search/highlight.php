<?php

class HighLight {
	private $json;

	function __construct(Array $highlight, Array $pre_tags = array('[--!'), Array $post_tags = array('--]')) {
		$fields = array();
		$obj = new stdClass();
		foreach ($highlight as $key) {

			array_push($fields, array($key => $obj));
		}
		$result['pre_tags'] = $pre_tags;
		$result['post_tags'] = $post_tags;
		$result['fields'] = $fields;

		$this -> json = $result;
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