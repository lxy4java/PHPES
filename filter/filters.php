<?php

require_once "filter.php";

require_once "logicFilter.php";

class Filters {

	public static function all() {
		$obj = new stdClass();
		return new Filter( array('match_all' => $obj));
	}

	public static function equal($key, $value) {
		return new Filter( array('term' => array($key => $value)));
	}

	public static function prefix($key, $value) {
		return new Filter( array('prefix' => array($key => $value)));
	}

	public static function RegExp($key, $value) {
		return new Filter( array('regexp' => array($key => $value)));
	}

	public static function exists($field) {
		return new Filter( array('exists' => array('field' => $field)));
	}

	public static function multi_equal($key, Array $value, String $execution = NULL, bool $cache = NULL) {
		$arr = array('bool', 'and', 'or', 'plain', 'fielddata');
		if (!(in_array($execution, $arr))) {
			throw new Exception('please make sure operator is  and , or ');
		}
		$tmp = array($key => $value);
		if ($execution != NULL) {
			$tmp['execution'] = $execution;
		}
		if ($cache != NULL) {
			$tmp['_cache'] = $cache;
		}

		$result = array('terms' => $tmp);

		return new Filter($result);
	}

	public static function bool(Array $lgc) {

		$logic = LogicF::filter_logic($lgc);
		return new Filter( array('bool' => $logic));

	}

	public static function relAnd(Array $lgc) {

		$logic = LogicF::check($lgc);
		return new Filter( array('and' => $logic));

	}

	public static function relOr(Array $lgc) {

		$logic = LogicF::check($lgc);
		return new Filter( array('or' => $logic));

	}

	public static function relNot(Array $lgc) {

		$logic = LogicF::check($lgc);
		return new Filter( array('not' => $logic));

	}

}
?>