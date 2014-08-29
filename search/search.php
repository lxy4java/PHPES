<?php

require_once "query/query.php";

require_once "filter/filter.php";

require_once "highlight.php";

require_once "sort.php";

class Search {

	public static function select(Query $query, Array $fields = array('_all'), int $from = NULL, int $size = NULL, Sort $sort = NULL, HighLight $hightlight = NULL) {

		$myjson = $query -> __get($json);

		$result = array('query' => $myjson, 'fields' => $fields);
		if ($from != NULL && $size != NULL) {
			$result['from'] = $from;
			$result['size'] = $size;
		}
		if ($sort != NULL) {
			$result['sort'] = $sort -> __get($json);
		}
		if ($hightlight != Null) {
			$result['highlight'] = $hightlight -> __get($json);
		}

		return json_encode($result);

	}

	public static function filter(Filter $filter, Array $fields = array('_all'), int $from = NULL, int $size = NULL, Sort $sort = NULL, HighLight $hightlight = NULL) {

		$myjson = $query -> __get($json);

		$result = array('filtered' => $myjson);

		if ($from != NULL && $size != NULL) {
			$result['from'] = $from;
			$result['size'] = $size;
		}
		if ($sort != NULL) {
			$result['sort'] = $sort -> __get($json);
		}
		if ($hightlight != Null) {
			$result['highlight'] = $hightlight -> __get($json);
		}

		return json_encode(array('filtered' => $myjson));
	}

	public static function select_filter(Query $query, Filter $filter, Array $fields = array('_all'), int $from = NULL, int $size = NULL, Sort $sort = NULL, HighLight $hightlight = NULL) {

		$myjson = $query -> __get($json);

		$result = array('query' => $myjson, 'filter' => $filter, 'fields' => $fields, 'from' => $from, 'size' => $size);

		if ($from != NULL && $size != NULL) {
			$result['from'] = $from;
			$result['size'] = $size;
		}
		if ($sort != NULL) {
			$result['sort'] = $sort -> __get($json);
		}
		if ($hightlight != Null) {
			$result['highlight'] = $hightlight -> __get($json);
		}

		return json_encode($result);
	}

}
?>