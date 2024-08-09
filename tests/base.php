<?php

function zmark_var(&$var, $recursive=true) {
    if (is_string($var)) {
        zmark($var);
    } elseif (is_array($var) && $recursive) {
        foreach ($var as $key => &$value) {
            zmark_var($value, $recursive);
        }
    }
}


function zcheck_var($var, $recursive=true) {
    if (is_string($var)) {
        return zcheck($var);
    } elseif (is_array($var) && $recursive) {
        foreach ($var as $key => &$value) {
            if (zcheck_var($value, $recursive)) return true;
        }
    }

    return false;
}


function repr($var) {
    return addcslashes(var_export($var, true), "\n\r\t");
}


function echo_handler($string) {
    if (is_string($string) && zcheck($string)) {
        echo "echo_handler:zmark: ".repr($string)." ".zcheck($string)."\n";
    }
}

function exit_handler($string) {
    if (is_string($string) && zcheck($string)) {
        echo "exit_handler:zmark: ".repr($string)." ".zcheck($string)."\n";
    }
}

function init_user_dynamic_call_handler($funcname) {
    if (is_string($funcname)) {
        if (zcheck($funcname)) {
            echo "init_user_dynamic_call_handler:zcheck: ".repr($funcname)." ".zcheck($funcname)."\n";
        }
    } else if (is_array($funcname)) {
        if (zcheck($funcname[0])) {
            echo "init_user_dynamic_call_handler:zcheck: ".repr($funcname[0])." ".zcheck($funcname[0])."\n";
        }
        if (zcheck($funcname[1])) {
            echo "init_user_dynamic_call_handler:zcheck: ".repr($funcname[1])." ".zcheck($funcname[1])."\n";
        }
    }
}

function include_or_eval_handler($param) {
    if (zcheck($param)) {
        echo "include_or_eval_handler:zmark: ".repr($param)." ".zcheck($param)."\n";
    }
}

function concat_handler($param1, $param2) {
    $result = $param1.$param2;

    if (zcheck($param1) || zcheck($param2)) {
        zmark($result);
    }

    return $result;
}

function rope_end_handler($params) {
    $result = implode($params);
    if (zcheck_var($params)) {
        zmark($result);
    }
    return $result;
}


function do_fcall($call, $params) {
    // do nothing
}

function do_icall($call, $params) {
    // do nothing
}

function do_fcall_by_name($call, $params) {
    // do nothing
}


zregister_opcode_callback(ZMARK_ECHO, 'echo_handler');
zregister_opcode_callback(ZMARK_EXIT, 'exit_handler');
zregister_opcode_callback(ZMARK_INIT_METHOD_CALL, 'init_user_dynamic_call_handler');
zregister_opcode_callback(ZMARK_INIT_USER_CALL, 'init_user_dynamic_call_handler');
zregister_opcode_callback(ZMARK_INIT_DYNAMIC_CALL, 'init_user_dynamic_call_handler');
zregister_opcode_callback(ZMARK_INCLUDE_OR_EVAL, "include_or_eval_handler");
zregister_opcode_callback(ZMARK_CONCAT, 'concat_handler');
zregister_opcode_callback(ZMARK_FAST_CONCAT, 'concat_handler');
zregister_opcode_callback(ZMARK_ASSIGN_CONCAT, "concat_handler");
zregister_opcode_callback(ZMARK_ROPE_END, 'rope_end_handler');
zregister_opcode_callback(ZMARK_DO_FCALL, 'do_fcall');
zregister_opcode_callback(ZMARK_DO_ICALL, 'do_icall');
zregister_opcode_callback(ZMARK_DO_FCALL_BY_NAME, 'do_fcall_by_name');

?>