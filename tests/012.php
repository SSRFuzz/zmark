<?php

function exit_handler($string) {
    echo "in exit_handler $string\n";
}

zregister_opcode_callback(ZMARK_EXIT, 'exit_handler');


exit('quit');

echo "hello?";

?>
