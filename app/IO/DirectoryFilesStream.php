<?php
namespace App\IO;

/**
 * Class DirectoryFilesStream
 *
 * Stream of all files in a certain directory
 *
 * @package App\IO
 */
class DirectoryFilesStream implements FilesStream {

    private $handle;
    private $next;

    public function __construct($directory) {
        $this->directory = $directory;
        $this->handle = opendir($directory);
    }

    public function close() {
        closedir($this->handle);
    }

    public function hasNext() {
        $this->next = readdir($this->handle);
        return $this->nextIsDirectory() ? $this->hasNext() : $this->next !== false;
    }

    private function nextIsDirectory()
    {
        return is_dir($this->next);
    }

    public function next() {
        return $this->directory . $this->next;
    }

}