<?php

namespace App\Http\Services\FileBuilder;

use App\Http\Services\FileBuilder\Triats\CallMethod;
use App\Http\Services\FileBuilder\Triats\FileToolsService;

class UploadFile
{

    use FileToolsService, CallMethod;

    public function upload($type = false)
    {

        //type => for uploading in storage or public ==> false = publc , true = storage

        //set size
        $file = $this->getFile();
        $this->setFileSize($file->getSize());

        //listener provier

        $this->provider();

        //check for add to storage or public

        if ($type) {
            $this->uploadToStorage();
        } else {
            $this->uploadToPublic();
        }

        return $this->getFileAddress();
    }

    public function deleteFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
        return false;
    }

    private function uploadToStorage()
    {
        self::$file->storeAs($this->getFinalFileDirectory(), $this->getFinalFileName());
    }

    private function uploadToPublic()
    {
        self::$file->move(public_path($this->getFinalFileDirectory()), $this->getFinalFileName());
    }
}