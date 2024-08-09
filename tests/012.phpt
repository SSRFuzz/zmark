--TEST--
Check ZEND_EXIT
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.enable_rename=1
--FILE--
<?php

function exit_handler($string) {
    echo "in exit_handler $string\n";
}

zregister_opcode_callback(ZMARK_EXIT, 'exit_handler');


exit('quit');

echo "hello?";

?>
--EXPECTF--
in exit_handler quit
quit