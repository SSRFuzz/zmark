--TEST--
Check ZEND_DO_UCALL
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.enable_rename=1
--FILE--
<?php

function do_ucall($call, $params) {
    var_dump($call);
    var_dump($params);
}


zregister_opcode_callback(ZMARK_DO_UCALL, 'do_ucall');


function x() {}

x("xxxx", 123, array('aaa'));

?>
--EXPECTF--
string(1) "x"
array(3) {
  [0]=>
  string(4) "xxxx"
  [1]=>
  int(123)
  [2]=>
  array(1) {
    [0]=>
    string(3) "aaa"
  }
}