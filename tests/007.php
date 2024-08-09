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
