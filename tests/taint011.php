<?php

function main() {
    global $var;
    $a = "tainted string\n";
    zmark($a);
    $var = $a;
    echo $var;
}

main();
echo $var;

?>
