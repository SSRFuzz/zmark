<?php

error_reporting(0);

function echo_handler($string) {
    echo "in echo_handler $string";
}

zregister_opcode_callback(ZMARK_ECHO, 'echo_handler');

class A {
    public function say(&$str) {
        echo $str;
    }

    public function __toString() {
        return "A\n";
    }
}

function say(&$str) {
    echo $str;
}

echo "hello\n";
print "hello\n";

$d = "test\n";
echo $d;
say($d);


$a = new A();
$a->say($d);
echo $a;

$f = array(1, 2, 3, 4);
echo $f;

?>
