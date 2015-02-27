<?php
namespace App\IO;

use Symfony\Component\Yaml\Exception\ParseException;

class JsonObjectStream {

    /**
     * @var FileLineStream
     */
    private $fileLineStream;

    public function __construct(FileLineStream $fileLineStream) {
        $this->fileLineStream = $fileLineStream;
    }

    public function hasNext() {
        return $this->fileLineStream->hasNext();
    }

    public function next() {
        $rawJsonObject = json_decode($this->fileLineStream->next());
        if (is_null($rawJsonObject))
            throw new ParseException("Empty JSON line cannot be mapped");

        return $rawJsonObject;
    }

}