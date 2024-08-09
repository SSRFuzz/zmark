<?php

namespace Test;

function before_rename($param1, $param2) {
    var_dump($param1);
    var_dump($param2);
}

echo "before rename\n";
before_rename("before", 123);

zrename_function('Test\before_rename', 'Test\after_rename');
echo "after rename\n";
after_rename("after", 321);

class Hello {
    public function say() {
        echo "I am hello";
    }
}

zrename_class("Test\Hello", "Test\_Hello");

$a = new _Hello();
$a->say();

