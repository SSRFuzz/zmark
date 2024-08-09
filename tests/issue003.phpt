--TEST--
Check for Reflection::getName
--SKIPIF--
<?php if (!extension_loaded("zmark") || !extension_loaded("sqlite3")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_functions=system:vgfuzzer_system
--FILE--
<?php

$ret = new ReflectionFunction('vgfuzzer_system');
$name = $ret->getName();
var_dump($name);


?>
--EXPECT--
string(15) "vgfuzzer_system"
