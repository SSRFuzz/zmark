--TEST--
Check Taint with functions
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_functions=sprintf:my_sprintf, vsprintf:my_vsprintf, explode:my_explode, implode:my_implode, join:my_join, trim:my_trim, rtrim:my_rtrim, ltrim:my_ltrim
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php


function sprintf($format, $string , ...$args) {
    $result = my_sprintf($format, $string, ...$args);
    if (zcheck($string)) {
        zmark($result);
    }

    return $result;
}


function vsprintf($format, $args) {
    $result = my_vsprintf($format, $args);

    if (zcheck($format)) {
        zmark($result);
    } else if (zcheck_var($args)) {
        zmark($result);
    }

    return $result;
}


function explode($delimiter, $string , ...$args) {
    $result = my_explode($delimiter, $string, ...$args);

    if (zcheck($string)) {
        zmark_var($result);
    } else if (zcheck($delimiter)) {
        zmark_var($result);
    }

    return $result;
}


function implode($string , ...$args) {
    $result = my_implode($string, ...$args);
    if (zcheck_var($string)) {
        zmark($result);
    } else if (zcheck_var($args[0])) {
        zmark($result);
    }

    return $result;
}


function join($string , ...$args) {
    $result = my_implode($string, ...$args);
    if (zcheck_var($string)) {
        zmark($result);
    } else if (zcheck_var($args[0])) {
        zmark($result);
    }

    return $result;
}


function trim($string , ...$args) {
    $result = my_trim($string, ...$args);
    if (zcheck($string)) {
        zmark($result);
    }

    return $result;
}


function rtrim($string , ...$args) {
    $result = my_rtrim($string, ...$args);
    if (zcheck($string)) {
        zmark($result);
    }

    return $result;
}


function ltrim($string , ...$args) {
    $result = my_ltrim($string, ...$args);
    if (zcheck($string)) {
        zmark($result);
    }

    return $result;
}


$a = "tainted string";
zmark($a);

$b = sprintf("%s", $a);
var_dump(zcheck($b));

$b = vsprintf("%s", array($a));
var_dump(zcheck($b));

$b = explode(" ", $a);
var_dump(zcheck($b[0]));

$a = implode(" ", $b);
var_dump(zcheck($a));

$a = join(" ", $b);
var_dump(zcheck($a));

$b = trim($a);
var_dump(zcheck($a));

$b = rtrim($a, "a...Z");
var_dump(zcheck($a));

$b = ltrim($a);
var_dump(zcheck($a));

?>
--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)