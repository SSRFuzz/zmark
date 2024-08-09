--TEST--
Check SQLite3
--SKIPIF--
<?php if (!extension_loaded("zmark") || !extension_loaded("sqlite3")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_classes=SQLite3:MySQLite3
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

class SQLite3 extends MySQLite3 {
    public function prepare($sql, ...$args) {
        if (zcheck($sql)) {
            echo "prepare-zcheck: ".zcheck($sql)."\n";
        }
        return parent::prepare($sql, ...$args);
    }

    public function query($sql, ...$args) {
        if (zcheck($sql)) {
            echo "query-zcheck: ".zcheck($sql)."\n";
        }
        return parent::query($sql, ...$args);
    }
}

$db = new SQLite3(':memory:');

$sql = "select 1";
zmark($sql);

$db->prepare($sql);
$db->query($sql);

?>
--EXPECT--
prepare-zcheck: 1
query-zcheck: 1