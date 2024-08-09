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
