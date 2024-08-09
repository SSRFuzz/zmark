<?php

$a = "tainted string" . ".\n";
zmark($a);
$b = array("");
$b[0] .= $a;
var_dump(zcheck($b[0]));
$c = new stdClass();
$c->foo = "this is";
$c->foo .= $b[0];
echo $b[0];  // Segmentation fault
var_dump(zcheck($c->foo));

?>
