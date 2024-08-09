<?php


$a = "a tainted string\n";
zmark($a);

function test1(&$a) {
   echo $a;
}

function test2($b) {
   echo $b;
}

echo "======= normal test ======\n";
test1($a);
test2($a);

echo "======= normal a&b ======\n";

$b = $a;

test1($a);
test2($b);

echo "======= normal c&d ======\n";

$c = "c tainted string\n";
zmark($c);

$e = &$c;

test1($c);
test2($e);

?>
