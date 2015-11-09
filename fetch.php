<?php
error_reporting(E_ERROR | E_PARSE);

/* check useragent & referer */
$bad_agents = array('Kodi', 'XBMC');
foreach($bad_agents as $agent) {
	if (strpos($_SERVER['HTTP_USER_AGENT'], $agent) !== false) {
		header('HTTP/1.0 403 Forbidden');
		exit();
	}
}

if (isset($_SERVER['HTTP_REFERER'])) {
	if (strpos($_SERVER['HTTP_REFERER'], 'src') !== false) {
		header('HTTP/1.0 403 Forbidden');
		exit();
	}
}

/* extract fetch url */
$url = str_replace('/fetch.php/', 'http://', $_SERVER['REQUEST_URI']);
$pos = strpos($url, '?');
if ($pos !== false) {
	$url = substr($url, 0, $pos);
}
header('X-Request-URL: ' . $url);

/* parse parameters & headers */
$parameters = array();
$headers = array();
$headers['User-Agent'] = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';
foreach ($_GET as $name => $value) {
	if (substr($name, 0, 2) === "X-") {
		$headers[substr($name, 2)] = $value;
	} else {
		$parameters[$name] = $value;
	}
}
$headers_arr = array();
foreach ($headers as $name => $value) {
	$headers_arr[] = $name . ': ' . $value;
}

if (count($parameters) > 0) {
	$url = $url . '?' . http_build_query($parameters);
}

/* initiate curl */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_arr);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

/* download */
$content = curl_exec ($ch);
$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

/* output headers */
#header('Access-Control-Allow-Origin: *');
if (strpos($url, '.ts') !== FALSE)
	header('Cache-Control: public, max-age=300');
else if (strpos($url, '.m3u8') !== FALSE)
	header('Cache-Control: public, max-age=5');
else
	header('Cache-Control: no-cache');

/* output content */
header('Content-Type: ' . $content_type);
echo $content;
?>
