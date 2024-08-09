--TEST--
Check zmark(), zcheck(), zclear()
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

$a = "hello world";
$b = "你好世界";

zmark($a);

var_dump(zcheck($a));
var_dump(zcheck($b));

zclear($a);
var_dump(zcheck($a));

zmark($b);
var_dump(zcheck($b));

zmark($b);
var_dump(zcheck($b));

$a = "hello";
$hello = "aaaa";
zmark($a);
zmark($hello);

echo $$a;
?>
--EXPECTF--
bool(true)
bool(false)
bool(false)
bool(true)
bool(true)
echo_handler:zmark: 'aaaa' 1
aaaa