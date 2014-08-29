<?php

class ESClient {

	public static function curl($url, $data = null, $opr = "POST") {

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $opr);

		if ($data != null && $opr == "POST") {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));

		return curl_exec($ch);

	}

	public static function select($url, $data, $index = null, $type = null) {
		if ($index == null) {
			$url = $url . "/_search";
		} else {
			if (type == null) {
				$url = $url . "/" . $index . "/_search";
			} else {
				$url = $url . "/" . $index . "/" . $type . "/_search";
			}
		}

		$result = ESClient::curl($url, $data);
		return $result;
	}

	public static function insert($url, $data, $index, $type, $id = null) {
		if ($id == null) {
			$url = $url . "/" . $index . "/" . $type;
		} else {
			$url = $url . "/" . $index . "/" . $type . "/" . $id;
		}

		$result = ESClient::curl($url, $data);
		return $result;

	}

	public static function delete($url, $index, $type, $id) {

		if ($id == null) {

			return "error;  no id";
		}
		$url = $url . "/" . $index . "/" . $type . "/" . $id;

		$result = ESClient::curl($url, null, "DELETE");

		return $result;
	}

}
?>
