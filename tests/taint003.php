<?php

$a = "tainted string";
zmark($a);

$b = isset($a)? $a : 0;
echo $b;
echo "\n";

$b .= isset($a)? "xxxx" : 0; //a knew mem leak
var_dump(zcheck($b));
exit($b);

?>
