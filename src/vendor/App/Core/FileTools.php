<?php

/**
 * returns a plain string array of path to all files in a directory, and subdirectories,
 * but does not return directories themselves. (meaning if a directory is empty, it will not be included at all)
 *
 * @param string $dir
 * @throws UnexpectedValueException if $dir is not readable/does not exists
 * @return string[] files
 */
class FileTools
{


    function __construct()
    {

     //   $this->denem = "asd";

    }
    public function get_file_list_recursively(string $dir, string $fileFilter = null): array
    {
        $files = array();
        $files = [];
        if (!is_readable($dir)) {

            return false;

        }
        foreach ((new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS))) as $file) {
            /** @var SplFileInfo $file */

            if (is_readable($file->getRealPath())) {
                if ($fileFilter != null and $file->getExtension() === $fileFilter) {
                    $files[] = $file->getRealPath();
                } elseif ($fileFilter === null) {
                    $files[] = $file->getRealPath();
                }
            }

        }
        return $files;
    }
}





?>