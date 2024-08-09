#!/bin/sh
keepfiles="php_zmark.h zmark.c abc.php config.m4 config.w32 CREDITS LICENSE EXPERIMENTAL clean.sh artwork README.md README.zh-CN.md EXPERIMENTAL tests .appveyor .gitignore .travis.yml .appveyor.yml .vscode .git .travis"
allfiles=$(ls -a .)
for f in $allfiles
do
        echo "$keepfiles" | grep -q "$f"
        if [ $? -ne 0 ]
        then
                rm -rf $f
        fi
done