<?php

if (!function_exists('array_key_rm')) {
    /**
     * return a new array which doesn't exists the target key
     *
     * @param $key mixed target key
     * @param $arr array src array
     * @return array new array which doesn't exists the target key
     */
    function array_key_rm($key, array $arr)
    {
        if (!array_key_exists($key, $arr)) {
            return $arr;
        }
        $keys = array_keys($arr);
        $index = array_search($key, $keys);
        if ($index !== FALSE) {
            array_splice($arr, $index, 1);
        }
        return $arr;
    }
}


if (!function_exists('array_copy')) {
    /**
     * copy the element of a array to another one
     * @param $array array source array
     * @return array new array with all elements from the source
     */
    function array_copy($array)
    {
        $result = array();
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $result[$key] = array_copy($val);
            } elseif (is_object($val)) {
                $result[$key] = clone $val;
            } else {
                $result[$key] = $val;
            }
        }
        return $result;
    }
}

if (!function_exists('array_value_of')) {
    /**
     * read value from array by key
     * @param $key mixed key
     * @param $array array source array
     * @param $default mixed default value
     * @return mixed the value
     */
    function array_value_of($key, array $array, $default = NULL)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        return $default;
    }
}


if (!function_exists('build_tree')) {

    function add_children($array, &$root, $id_key = 'id', $parent_key = 'parent', $children_key = 'children')
    {
        if (empty($root) || empty($array)) {
            return;
        }
        $id = $root[$id_key];
        foreach ($array as $ele) {
            $p = empty($ele[$parent_key]) ? 0 : $ele[$parent_key];
            if (empty($root[$children_key])) {
                $root[$children_key] = array();
            }
            if ($id == $p) {
                add_children($array, $ele, $id_key, $parent_key, $children_key);
                array_push($root[$children_key], $ele);
            }
            if (empty($root[$children_key])) {
                unset($root[$children_key]);
            }
        }
    }

    /**
     * build tree from array
     * @param $array array src array
     * @param $root array root node of tree
     * @param $default_id_value mixed default root node id key value
     * @param $id_key string id key of tree node
     * @param $parent_key string parent key of tree node
     * @param $children_key string children key of tree node
     * @return array tree
     */
    function build_tree(array $array, $root = array(), $id_key = 'id', $parent_key = 'parent', $children_key = 'children', $default_id_value = 0)
    {
        $root = empty($root) ? array() : $root;
        if (empty($root[$id_key])) {
            $root[$id_key] = $default_id_value;
        }
        add_children($array, $root, $id_key, $parent_key, $children_key);
        return $root;
    }
}
