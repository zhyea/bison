<?php


if (!function_exists('println')) {
    /**
     * print string in line
     *
     * @param $str string
     */
    function println($str)
    {
        echo "$str <BR/>";
    }
}


if (!function_exists('str_start_with')) {
    /**
     * Check is str1 start with str2
     *
     * @param $str1 string target string
     * @param $str2 string compare string
     * @return bool
     */
    function str_start_with(string $str1, string $str2)
    {
        if (empty($str2)) {
            return false;
        }
        return strpos($str1, $str2) === 0;
    }
}


if (!function_exists('str_len_cmp')) {
    /**
     * Compare str1 and str2 with length
     *
     * @param $str1 string target string
     * @param $str2 string compare string
     * @return bool
     */
    function str_len_cmp(string $str1, string $str2)
    {
        return strlen($str2) - strlen($str1);
    }
}


if (!function_exists('str_end_with')) {
    /**
     * Check is str1 end with str2
     *
     * @param $str1 string target string
     * @param $str2 string compare string
     * @return bool
     */
    function str_end_with(string $str1, string $str2)
    {
        return strrchr($str1, $str2) === $str2;
    }
}


if (!function_exists('mb_trim')) {
    /**
     * remove the non character flags from str
     * @param $str string src str
     * @return false|string result
     */
    function mb_trim(string $str)
    {
        $str = mb_ereg_replace('^(([ \r\n\t])*(　)*)*', '', $str);
        $str = mb_ereg_replace('(([ \r\n\t])*(　)*)*$', '', $str);
        return $str;
    }
}


if (!function_exists('sub_string')) {
    /**
     * enhance the core sub_str function
     * @param $str string the source string
     * @param int $length the length to sub
     * @param bool $append add '...' as end
     * @param string $charset charset
     * @return string
     */
    function sub_string(string $str, $length = 0, $append = true, $charset = 'UTF-8')
    {
        $str = trim($str);
        $str_length = strlen($str);
        if ($length == 0 || $length >= $str_length) {
            return $str;
        } elseif ($length < 0) {
            $length = $str_length + $length;
            if ($length < 0) {
                $length = $str_length;
            }
        }
        if (function_exists('mb_substr')) {
            $new_str = mb_substr($str, 0, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            $new_str = iconv_substr($str, 0, $length, $charset);
        } else {
            $new_str = substr($str, 0, $length);
        }
        if ($append && $str != $new_str) {
            $new_str .= '...';
        }
        return $new_str;
    }
}