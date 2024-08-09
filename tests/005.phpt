--TEST--
Check zrename_class
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.enable_rename=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

class Hello {
    public function say() {
        echo "I am hello";
    }
}

zrename_class("Hello", "_Hello");

$a = new _Hello();
$a->say();


?>
--EXPECTF--
I am hello