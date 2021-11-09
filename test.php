<?php $json = file_get_contents("http://ipinfo.io/".$_SERVER['REMOTE_ADDR']."/json");
    $details = json_decode($json);
	var_dump($details);
