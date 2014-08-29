<?php

class LogicF {

	public static function check($val) {

		if (is_array($val)) {
			$value = array();
			foreach ($val as $key) {
				if ($key instanceof Filter) {
					$query = $key -> __get($json);
					array_push($value, $query);
				} else {

					throw new Exception('please make sure the params of  logic object is  Query');
				}
			}
			return $value;
		} else if ($val instanceof Filter) {

			return $val -> __get($json);
		} else {
			throw new Exception('please make sure the params of  logic object is  Query !');

		}

	}

	public static function filter_logic(Array $lgc) {
		foreach ($lgc as $key => $val) {
			$val = self::check($val);
			if ($key == 'and') {
				$arr['must'] = $val;

			} else if ($key == 'not') {
				$arr['must_not'] = $val;
			} else if ($key == 'should') {
				$arr['must_not'] = $val;
			} else {
				throw new Exception('the bool logic only support and ,or ,not  ');

			}

		}
		return $arr;
	}

}
?>