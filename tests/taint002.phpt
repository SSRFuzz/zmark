--TEST--
Check Taint function
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_functions=file_put_contents:my_file_put_contents
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

function file_put_contents($filename, $data, ...$args) {
    if (zcheck_var($filename)) {
        echo "file_put_contents:zcheck: filename ".zcheck_var($filename)."\n";
    }

    if (zcheck_var($data)) {
        echo "file_put_contents:zcheck: data ".zcheck_var($data)."\n";
    }

    return my_file_put_contents($filename, $data, ...$args);
}


$a = "tainted string";
zmark($a);

print $a."\n";
$a .= '+';
$sql = "select * from {$a}";

file_put_contents("php://output", $a . "\n");
eval("return '$a';");

?>
--EXPECT--
echo_handler:zmark: 'tainted string\n' 1
tainted string
file_put_contents:zcheck: data 1
tainted string+
include_or_eval_handler:zmark: 'return \'tainted string+\';' 1