<?php
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$req = file_get_contents("php://input");
	}