<?php

$a = array();
$a[0] = "tainted string<>";
zmark($a[0]);

function xxx(&$item) {
    $item = htmlspecialchars($item);
}

array_walk_recursive($a, "xxx");

echo $a[0];

?>
