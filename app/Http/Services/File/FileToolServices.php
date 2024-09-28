<?php

namespace App\Http\Services\File;

class FileToolServices
{
    public $exclusiveDirectory;
    public $fileName;
    public $fileFormat;
    public $fileSize;
    public $fileType;
    public $fileDirectory;
    public $finalFileDirectory;
    public $finalFileName;
    public $fileAddress;
    public $file;

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setExclusiveDirectory($exclusiveDirectory)
    { 
        $this->exclusiveDirectory = $exclusiveDirectory;
    }

    public function getExclusiveDirectory()
    { 
        return $this->exclusiveDirectory;
    }

    public function setFileName($fileName)
    { 
        $this->fileName = $fileName;
    }

    public function getFileName()
    { 
        return $this->fileName;
    }

    public function setFileFormat($fileFormat)
    { 
        $this->fileFormat = $fileFormat;
    }

    public function getFileFormat()
    { 
        return $this->fileFormat;
    }

    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    public function getFileSize()
    {
        return $this->fileSize;
    }

    public function setFileType($fileType)
    {
        $this->fileType = $fileType;
    }

    public function getFileType()
    {
        return $this->fileType;
    }

    public function setFileDirectory($fileDirectory)
    {
        $this->fileDirectory = $fileDirectory;
    }

    public function getFileDirectory()
    {
        return $this->fileDirectory;
    }

    public function setFinalFileDirectory($finalFileDirectory)
    {
        $this->finalFileDirectory = $finalFileDirectory;
    }

    public function getFinalFileDirectory()
    {
        return $this->finalFileDirectory;
    }

    public function setFinalFileName($finalFileName)
    {
        $this->finalFileName = $finalFileName;
    }

    public function getFinalFileName()
    {
        return $this->finalFileName;
    }

    public function getFileAddress()
    {
        return $this->getFinalFileDirectory() . DIRECTORY_SEPARATOR . $this->getFinalFileName();
    }

    public function checkDirectory($fileDirectory)
    {
        if(!file_exists($fileDirectory)){
            mkdir($fileDirectory , 0777 , true);
        }
    }

    public function provider()
    {
        $this->getExclusiveDirectory() ?? $this->setExclusiveDirectory("file" . DIRECTORY_SEPARATOR . date("Y") . DIRECTORY_SEPARATOR . date("M") . DIRECTORY_SEPARATOR .date("d"));
        $this->getFileName() ?? $this->setFileName(time());
        $this->getFileFormat() ?? $this->setFileFormat($this->file->extension());

        $finalFileDirectory = $this->getFileDirectory() == null ? $this->getExclusiveDirectory() : $this->getExclusiveDirectory() . DIRECTORY_SEPARATOR . $this->getFileDirectory();

        $this->setFinalFileDirectory($finalFileDirectory);
        
        
        $finalFileName = $this->getFileName() . "." . $this->getFileFormat();
        $this->setFinalFileName($finalFileName);

        $this->checkDirectory($finalFileDirectory);
    }
}
