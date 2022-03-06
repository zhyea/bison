<?php


if (!function_exists('real_path')) {
    /**
     * return absolute path
     *
     * @param $path string
     * @return string
     */
    function real_path(string $path): string
    {
        if (($_temp = realpath($path)) !== FALSE) {
            return $_temp . DIRECTORY_SEPARATOR;
        } else {
            return strtr(
                    rtrim($path, '/\\'),
                    '/\\',
                    DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
                ) . DIRECTORY_SEPARATOR;
        }
    }
}


if (!function_exists('append_child_path')) {
    /**
     * add child path to parent path
     *
     * @param $parent_dir string parent path
     * @param $child_path string child path
     * @return string
     */
    function append_child_path(string $parent_dir, string $child_path): string
    {
        return $parent_dir . strtr(
                trim($child_path, '/\\'),
                '/\\',
                DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
            );
    }
}


if (!function_exists('get_files')) {

    /**
     * get files from certain path
     *
     * @param $path string the path
     * @param $recursive boolean  read recursively
     * @return array the files;
     */
    function get_files(string $path, bool $recursive = false): array
    {
        $result = array();

        if (is_dir($path)) {
            $files = scandir($path);
            foreach ($files as $f) {
                $sub_path = (str_end_with($path, '/') ? $path : $path . '/') . $f;
                if ($f == '.' || $f == '..') {
                    continue;
                } else if (is_dir($sub_path) && $recursive) {
                    $sub_files = get_files($sub_path, $recursive);
                    if (sizeof($sub_files) > 0) {
                        array_push($result, ...$sub_files);
                    }
                } else {
                    array_push($result, $sub_path);
                }
            }
        }
        return $result;
    }
}


if (!function_exists('del_file')) {

    /**
     * delete file
     *
     * @param $path string path of file
     */
    function del_file(string $path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}


if (!function_exists('del_dir')) {
    /**
     * delete dir
     * @param $dir string path of dir
     * @return bool
     */
    function del_dir(string $dir): bool
    {
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $full_path = $dir . DIRECTORY_SEPARATOR . $file;
                if (!is_dir($full_path)) {
                    unlink($full_path);
                } else {
                    del_dir($full_path);
                }
            }
        }

        closedir($dh);

        if (rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }
}
