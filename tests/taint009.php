<?php


$a = "tainted string";
zmark($a); //must use concat to make the string not a internal string(introduced in 5.4)

$b = htmlspecialchars($a);
var_dump(zcheck($b));
var_dump(zcheck($a));


?>
