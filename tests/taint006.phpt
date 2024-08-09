--TEST--
Check Taint with send_var/send_ref
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
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
--EXPECT--
======= normal test ======
echo_handler:zmark: 'a tainted string\n' 1
a tainted string
echo_handler:zmark: 'a tainted string\n' 1
a tainted string
======= normal a&b ======
echo_handler:zmark: 'a tainted string\n' 1
a tainted string
echo_handler:zmark: 'a tainted string\n' 1
a tainted string
======= normal c&d ======
echo_handler:zmark: 'c tainted string\n' 1
c tainted string
echo_handler:zmark: 'c tainted string\n' 1
c tainted string