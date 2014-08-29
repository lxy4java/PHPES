<?php

$TESCLIENT = "localhost:9200/";

require_once "../client/client.php";

/**
 * GET 会返回版本号,you knonw for search
 *
 * */

function TesGet() {
	global $TESCLIENT;
	return ESClient::curl($TESCLIENT, null, "GET");
}

/***
 * insert 未指定id,elasticsearch使用自己生成的唯一id
 * 建议指定id为数据库主键
 *
 * */
function TesInsert($id = null) {
	global $TESCLIENT;
	$data = json_encode(array("name" => "lxy", "age" => 24, "gender" => "m"));
	if ($id == null) {
		return ESClient::insert($TESCLIENT, $data, "lxy", "test");
	} else {
		return ESClient::insert($TESCLIENT, $data, "lxy", "test", $id);
	}
}

/***
 *
 * 这里只给定根据id删除数据,不建议对数据进行删除操作
 *
 * **/
function TesDelete($id) {
	global $TESCLIENT;
	return ESClient::delete($TESCLIENT, "lxy", "test", $id);
}

/**
 * 这里自己写json查询语句,后面会对语句进行封装
 * */
function TesSelect() {
	global $TESCLIENT;
	$data = '{"query":{"match_all":{}}}';
	return ESClient::select($TESCLIENT, $data);
}

//$result = TesGet();
/*
 * string(312) "{ "status" : 200, "name" : "Cannonball I",
 * "version" : { "number" : "1.3.1",
 * "build_hash" : "2de6dc5268c32fb49b205233c138d93aaf772015",
 *  "build_timestamp" : "2014-07-28T14:45:15Z",
 * "build_snapshot" : false, "lucene_version" : "4.9" },
 *  "tagline" : "You Know, for Search" } "
 * */

//$result = TesInsert();
/*string(90) "{"_index":"lxy","_type":"test","_id":"30I5ICjITtCVoumcPSi8SA","_version":1,"created":true}"*/

//$result = TesInsert(1);
/* string(69) "{"_index":"lxy","_type":"test","_id":"1","_version":1,"created":true}" */

//$result =TesDelete(1);
/*string(67) "{"found":true,"_index":"lxy","_type":"test","_id":"1","_version":2}"*/

$result=TesSelect(); 
/**string(470) "{"took":116,"timed_out":false,"_shards":
 * {"total":5,"successful":5,"failed":0},"hits":
 * {"total":3,"max_score":1.0,"hits":
 * [{"_index":"lxy","_type":"test","_id":"1","_score":1.0,"_source":
 * {"name":"lxy","age":24,"gender":"m"}},
 * {"_index":"lxy","_type":"test","_id":"30I5ICjITtCVoumcPSi8SA","_score":1.0,"_source":
 * {"name":"lxy","age":24,"gender":"m"}},
 * {"_index":"lxy","_type":"test","_id":"H0va6A3RTryOxcj75Mvo-A","_score":1.0,"_source":
 * {"name":"lxy","age":24,"gender":"m"}}]}}"
 */
var_dump($result);
?>