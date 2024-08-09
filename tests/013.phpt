--TEST--
Check ZEND_INIT_METHOD_CALL
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.enable_rename=1
--FILE--
<?php

function init_method_call_handler($string) {
    echo "in init_method_call_handler $string\n";
}

// TODO: 暂时没去获取 class name, ZEND_DO_FCALL 可以
zregister_opcode_callback(ZMARK_INIT_METHOD_CALL, 'init_method_call_handler');


class A {
    public function say() {
        echo "in class A->say()\n";
    }
}


$a = new A();
$a->say();

?>
--EXPECTF--
in init_method_call_handler say
in class A->say()