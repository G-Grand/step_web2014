<?php
	if($_SERVER['REQUEST_METHOD'] == "POST") {

		$req = file_get_contents("php://input");
		if($req) $req = json_decode($req);
		else { echo '{"response": "bad request"}'; exit; }

		if($req->count == "all") {
			$sql = "SELECT id, name, description, img, price, category FROM cms_product";
		}elseif($req->count == "part") {
			$sql = "SELECT id, name, description, img, price, category FROM cms_product LIMIT " . $req->number;
		}else {
			echo '{"response": "bad data"}'; exit;
		}

		mysql_connect("localhost", "root", "");
		mysql_select_db('cms_project');
		$res = mysql_query($sql);

		$arr = array();
		if($res){
			while( $row = mysql_fetch_assoc($res)) {
				$arr[] = $row;
			}
			echo '{"response": ' . json_encode($arr) . '}';
		}else { echo '{"response": "bad query"}'; exit; }
	}else echo '{"response": "bad requset type"}';