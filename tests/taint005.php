<?php

$a = "tainted string\n";
zmark($a); //must use concat to make the string not a internal string(introduced in 5.4)

$b = $a;
$c = &$b; //separation
echo $b;
print $c;

$e = $a; //separation
echo $e;
print $a;

?>
