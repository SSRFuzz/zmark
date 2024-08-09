<?php
$a = "tainted string";
zmark($a);
function test($test)
{
	$data .= $test; // $data doesn't exist yet.
}

test($a);
