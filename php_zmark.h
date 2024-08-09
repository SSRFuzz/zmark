/*
  +----------------------------------------------------------------------+
  | PHP Version 7                                                        |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2017 The PHP Group                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Author:                                                              |
  +----------------------------------------------------------------------+
*/

/* $Id$ */

#ifndef PHP_ZMARK_H
#define PHP_ZMARK_H

extern zend_module_entry zmark_module_entry;
#define phpext_zmark_ptr &zmark_module_entry

#define PHP_ZMARK_VERSION "1.0.1-dev"

#ifdef PHP_WIN32
#   define PHP_ZMARK_API __declspec(dllexport)
#elif defined(__GNUC__) && __GNUC__ >= 4
#   define PHP_ZMARK_API __attribute__ ((visibility("default")))
#else
#   define PHP_ZMARK_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

#if PHP_VERSION_ID < 70300
#   define IS_ZMARK_FLAG            (1<<6)
#   define ZMARK_FLAG(str)          (GC_FLAGS((str)) |= IS_ZMARK_FLAG)
#   define ZCLEAR_FLAG(str)         (GC_FLAGS((str)) &= ~IS_ZMARK_FLAG)
#   define ZCHECK_FLAG(str)         (GC_FLAGS((str)) & IS_ZMARK_FLAG)
#else
#   define EX_CONSTANT(op)          RT_CONSTANT(EX(opline), op)
#   define IS_ZMARK_FLAG            (1<<5)
#   define ZMARK_FLAG(str)          GC_ADD_FLAGS(str, IS_ZMARK_FLAG)
#   define ZCLEAR_FLAG(str)         GC_DEL_FLAGS(str, IS_ZMARK_FLAG)
#   define ZCHECK_FLAG(str)         (GC_FLAGS((str)) & IS_ZMARK_FLAG)
#endif


#define ZMARK_OP1_TYPE(opline)  ((opline)->op1_type)
#define ZMARK_OP2_TYPE(opline)  ((opline)->op2_type)


#define ZMARK_IS_FUNCTION   1 << 0
#define ZMARK_IS_CLASS      1 << 1


#if PHP_VERSION_ID < 70100
#define ZMARK_RET_USED(opline) (!((opline)->result_type & EXT_TYPE_UNUSED))
#define ZMARK_ISERR(var)       ((var) == &EG(error_zval))
#define ZMARK_ERR_ZVAL(var)    ((var) = &EG(error_zval))
#else
#define ZMARK_RET_USED(opline) ((opline)->result_type != IS_UNUSED)
#define ZMARK_ISERR(var)       (Z_ISERROR_P(var))
#define ZMARK_ERR_ZVAL(var)    (ZVAL_ERROR(var))
#endif


ZEND_BEGIN_MODULE_GLOBALS(zmark)
    zend_bool   enable;
    zend_bool   enable_rename;
    zend_bool   in_callback;
    char *rename_functions;
    char *rename_classes;
    HashTable   callbacks;
ZEND_END_MODULE_GLOBALS(zmark)

/* Always refer to the globals in your function as ZMARK_G(variable).
   You are encouraged to rename these macros something shorter, see
   examples in any other php module directory.
*/
#define ZMARK_G(v) ZEND_MODULE_GLOBALS_ACCESSOR(zmark, v)

#if defined(ZTS) && defined(COMPILE_DL_ZMARK)
ZEND_TSRMLS_CACHE_EXTERN()
#endif

#if PHP_VERSION_ID < 70200
static zend_always_inline zend_string *zend_string_init_interned(const char *str, size_t len, int persistent)
{
    zend_string *ret = zend_string_init(str, len, persistent);

    return zend_new_interned_string(ret);
}
#endif

PHP_FUNCTION(zmark);
PHP_FUNCTION(zcheck);
PHP_FUNCTION(zclear);
PHP_FUNCTION(zrename_function);
PHP_FUNCTION(zrename_class);
PHP_FUNCTION(zregister_opcode_callback);

static void rename_from_ini_value(HashTable *ht, const char *ini_name, int type);
static zend_always_inline int zmark_zstr(zval *z_str);
static zend_always_inline Bucket *rename_hash_key(HashTable *ht, zend_string *orig_name, zend_string *new_name, int type);
static zend_always_inline Bucket *rename_hash_str_key(HashTable *ht, const char *orig_name, const char *new_name, int type);

#endif /* PHP_ZMARK_H */