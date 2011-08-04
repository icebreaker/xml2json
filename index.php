<?php
function print_output($content, $header="400 Bad Request")
{
	header("HTTP/1.0 $header");
	header("Content-type: application/json");
	echo json_encode($content) . "\n";
	exit;
}

$data = trim(file_get_contents("php://input"));

if (empty($data)) 
{
	print_output(array('error' => 'You must send POST data as `HTTP_RAW_POST_DATA`'));
}

$xml = @simplexml_load_string($data);
if (!$xml) 
{
	print_output(array('error' => 'Could not parse XML'));
}

header(iterator_to_array($xml), "202 Accepted");
