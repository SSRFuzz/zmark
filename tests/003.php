<?php

function before_rename($param1, $param2) {
    var_dump($param1);
    var_dump($param2);
}


echo "before rename\n";
before_rename("before", 123);

zrename_function("before_rename", "after_rename");
echo "after rename\n";
after_rename("after", 321);

?>
