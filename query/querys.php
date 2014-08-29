<?php
require_once "query.php";

require_once "logicQuery.php";
class Querys {

	public static function all() {
		$obj = new stdClass();
		return new Query( array('match_all' => $obj));
	}

	public static function equal($key, $value) {
		return new Query( array('term' => array($key => $value)));
	}

	public static function like($key, $value) {
		return new Query( array('match' => array($key => $value)));
	}

	public static function prefix($key, $value) {
		return new Query( array('prefix' => array($key => $value)));
	}

	public static function ranges($field, Array $value) {
		$arr = array('gt', 'lt', 'gte', 'lte');
		foreach ($value as $key => $val) {
			if (!(array_key_exists($key, $arr))) {
				throw new Exception('please make sure array key is  gt or gte or lt or lte');
			}
		}
		return new Query( array('range' => array($field => $value)));
	}

	public static function bool(Array $lgc) {

		$logic = LogicQ::query_logic($lgc);
		return new Query( array('bool' => $logic));

	}

	public static function query_string($value, Array $fields = array('_all'), BOOL_CAST $auto_parse = NULL, $operator = 'or') {
		if ($auto_parse == NULL) {
			$auto_parse = FALSE;
		}
		$arr = array('and', 'or');
		if (!(in_array($operator, $arr))) {
			throw new Exception('please make sure operator is  and , or ');
		}
		return new Query( array('query_string' => array('fields' => $fields, 'query' => $value, 'default_operator' => $operator, 'auto_generate_phrase_queries' => $auto_parse)));


}
?>