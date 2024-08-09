--TEST--
Check recalc stack size
--SKIPIF--
<?php if (!extension_loaded("zmark") || !extension_loaded("sqlite3")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.enable_rename=1
--FILE--
<?php

function hi() {
    echo "hi";
}

function fake_hi() {
    $c = new SQLite3("test.db");
    var_dump($c);
}

zrename_function('hi', 'zmark_hi');
zrename_function('fake_hi', 'hi');

hi();

unlink("test.db");

?>
--EXPECTF--
object(SQLite3)#1 (0) {
}