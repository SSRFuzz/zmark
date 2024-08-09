<?php

function dummy(&$a) {
	extract(array("b" => "ccc"));
	$a = $b;
}

$c = "xxx";
zmark($c);
dummy($c);
var_dump($c);

?>
