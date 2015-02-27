<?php
namespace App\IO;


class FileLineStream {

    /**
     * @var DirectoryFilesStream
     */
    private $filesStream;
    private $handle;

    public function __construct(DirectoryFilesStream $filesStream) {
        $this->filesStream = $filesStream;
    }

    public function hasNext() {
        if($this->shouldOpenNewFile()) {
            $this->closeOldFileIfNecessary();
            $this->openNewFileIfAvailable();
        }
        return $this->handle != null && get_resource_type($this->handle) == "stream" && !feof($this->handle);
    }

    /**
     * @return bool
     */
    private function shouldOpenNewFile()
    {
        return $this->handle == null || feof($this->handle);
    }

    private function closeOldFileIfNecessary()
    {
        if($this->handle != null) {
            fclose($this->handle);
        }
    }

    private function openNewFileIfAvailable()
    {
        if ($this->filesStream->hasNext()) {
            $file = $this->filesStream->next();
            //NOTE: gzopen() can be used to read a file which is not in gzip format
            //@see http://php.net/manual/en/function.gzopen.php
            $this->handle = gzopen($file, 'r');
        } else {
            $this->filesStream->close();
        }
    }

    public function next() {
        return fgets($this->handle);
    }

}