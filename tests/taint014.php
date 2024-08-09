<?php

class TClass {
    public function test() {}
}

function test() {
}

$fname = "test";

zmark($fname);

$fname();
call_user_func($fname);
call_user_func_array($fname, array());

$d = new TClass();
$d->$fname();
call_user_func(array($d, $fname));


?>
