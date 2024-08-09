--TEST--
Check clear run_time_cache
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.enable_rename=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php


function add_filter($tag) {
    echo "add_filter $tag\n";
    return true;
}

function add_action($tag) {
    return add_filter($tag);
}


function my_add_filter($tag) {
    echo "my_add_filter $tag\n";
    return true;
}


add_action("hello_tag1");

zrename_function("add_filter", "zmark_add_filter");
zrename_function("my_add_filter", "add_filter");


add_action("hello_tag1");
add_action("hello_tag2");
add_action("hello_tag3");

?>
--EXPECTF--
add_filter hello_tag1
my_add_filter hello_tag1
my_add_filter hello_tag2
my_add_filter hello_tag3