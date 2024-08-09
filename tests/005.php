<?php

class Hello {
    public function say() {
        echo "I am hello";
    }
}

zrename_class("Hello", "_Hello");

$a = new _Hello();
$a->say();


?>
