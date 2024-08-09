--TEST--
Bug #63123 (Hash pointer should be reset at the end of function:php_taint_mark_strings)
--SKIPIF--
<?php if (!extension_loaded("zmark") || !extension_loaded("sqlite3")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_functions=explode:my_explode
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

function explode($delimiter, $string , ...$args) {
    $result = my_explode($delimiter, $string, ...$args);

    if (zcheck($string)) {
        zmark_var($result, zcheck($string));
    } else if (zcheck($delimiter)) {
        zmark_var($result, zcheck($delimiter));
    }

    return $result;
}


$str = "a\n,b\n";
zmark($str);
$a = explode(',', $str);


foreach ($a as $key => $val) {
    echo $val;
}


?>
--EXPECT--
echo_handler:zmark: 'a\n' 1
a
echo_handler:zmark: 'b\n' 1
b