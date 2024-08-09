--TEST--
ISSUE #26 (PDO checking doesn't work)
--SKIPIF--
<?php if (!extension_loaded("zmark") || !extension_loaded("pdo_sqlite")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_classes=PDO:my_PDO
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

class PDO extends my_PDO {
    public function prepare($sql, $options=array()) {
        if (zcheck($sql)) {
            echo "prepare-zcheck: ".zcheck($sql)."\n";
        }
        return parent::prepare($sql, $options);
    }

    public function query($sql, ...$args) {
        if (zcheck($sql)) {
            echo "query-zcheck: ".zcheck($sql)."\n";
        }
        return parent::query($sql, ...$args);
    }
}


$db = new PDO("sqlite::memory:");
$sql = "select 1";
zmark($sql);
$stmt = $db->prepare($sql);
$stmt = $db->query($sql);

?>
--EXPECT--
prepare-zcheck: 1
query-zcheck: 1