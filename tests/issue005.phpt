--TEST--
Check for class internal properties
--SKIPIF--
<?php if (!extension_loaded("zmark") || !extension_loaded("mysqli")) print "skip"; ?>
--INI--
error_reporting=off
zmark.enable=1
zmark.rename_classes=mysqli:vgfuzzer_mysqli
--FILE--
<?php

$link = @new vgfuzzer_mysqli('localhost','root','123456_correct');
var_dump($link);

?>
--EXPECTF--
object(mysqli)#%d (%d) {
  ["affected_rows"]=>
  %s
  ["client_info"]=>
  %s
  ["client_version"]=>
  int(%d)
  ["connect_errno"]=>
  int(%d)
  ["connect_error"]=>
  string(%d) "%s"
  ["errno"]=>
  %s
  ["error"]=>
  %s
  ["error_list"]=>
  %s
  ["field_count"]=>
  %s
  ["host_info"]=>
  %s
  ["info"]=>
  %s
  ["insert_id"]=>
  %s
  ["server_info"]=>
  %s
  ["server_version"]=>
  %s
  ["stat"]=>
  %s
  ["sqlstate"]=>
  %s
  ["protocol_version"]=>
  %s
  ["thread_id"]=>
  %s
  ["warning_count"]=>
  %s
}