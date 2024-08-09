<?php

$a = "tainted string";
zmark($a);
$b = array("this is");
$b[0] .= $a;
var_dump(zcheck($b[0]));

$c = new stdClass();
$c->foo = "this is";
$c->foo .= $a;

var_dump(zcheck($c->foo));

?>
