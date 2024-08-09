<?php

$a = "tainted string" . ".";
zmark($a);

eval('$b = $a;');
die($b);

?>
