--TEST--
Check rename internal function
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_functions=phpinfo:myphpinfo, print_r:myprint_r
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

function phpinfo() {
    echo "rename phpinfo\n";
    print_r("call print_r");
}


function print_r() {
    echo "rename print_r";
}


phpinfo();
?>
--EXPECTF--
rename phpinfo
rename print_r