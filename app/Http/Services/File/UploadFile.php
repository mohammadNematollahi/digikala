<?php

namespace App\Http\Services\File;

use Illuminate\Support\Facades\Storage;
use App\Http\Services\File\FileToolServices;

class UploadFile extends FileToolServices
{
    public function upload($file , $type = false)
    {
        $this->setFileSize($file->getSize());
        $this->setFile($file);
        $this->provider();
        if($type){
            $this->uploadToStorage();
        }
        else{
            $this->uploadToPublic();
        }
        return $this->getFileAddress();
    }

    public function deleteFile($path){
        if(file_exists($path))
        {
            unlink($path);
        }
        return false;
    }

    private function uploadToStorage()
    {
        $this->file->storeAs($this->getFinalFileDirectory() , $this->getFinalFileName());
    }

    private function uploadToPublic()
    {
        $this->file->move(public_path($this->getFinalFileDirectory()) , $this->getFinalFileName());
    }
}
