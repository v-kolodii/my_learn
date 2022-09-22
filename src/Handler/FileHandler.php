<?php


namespace App\Handler;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHandler implements HandlerInterface
{
    private UploadedFile $file;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function prepareText()
    {
        return strip_tags($this->file->getContent());
    }

}