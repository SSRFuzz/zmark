--TEST--
Check unerialize
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_functions=unserialize:my_unserialize
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

function unserialize($obj) {
    if(zcheck($obj)) {
        echo "unserialize:zcheck: ".zcheck($obj)."\n";
    }

    return my_unserialize($obj);
}

$str = serialize(array());

zmark($str);

unserialize($str);


?>
--EXPECT--
unserialize:zcheck: 1