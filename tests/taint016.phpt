--TEST--
Check header
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_functions=header:my_header
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

function header($header, $replace=true, $http_response_code=200) {
    if(zcheck($header)) {
        echo "header:zcheck: ".zcheck($header)."\n";
    }

    // TODO:
    // return my_header($header);
}

$str = "Location: " . str_repeat("xx", 2);

zmark($str);

header($str);

?>
--EXPECT--
header:zcheck: 1

