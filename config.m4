dnl $Id$


PHP_ARG_ENABLE(zmark, whether to enable zmark support,
[  --enable-zmark           Enable zmark support])


if test -z "$PHP_DEBUG"; then
    AC_ARG_ENABLE(debug,
    [ --enable-debug      compile with debugging symbols],
    [ PHP_DEBUG=$enableval ],
    [ PHP_DEBUG=no ])
fi

if test "$PHP_TAINT" != "no"; then
    PHP_NEW_EXTENSION(zmark, zmark.c, $ext_shared)
fi
