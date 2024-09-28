<?php

namespace App\Http\Services\FileBuilder\Triats;

trait FileToolsService
{
    private static $exclusiveDirectory;
    private static $fileName;
    private static $fileFormat;
    private static $fileSize;
    private static $fileType;
    private static $fileDirectory;
    private static $finalFileDirectory;
    private static $finalFileName;
    private static $fileAddress;
    private static $file;

    public function setFile($file): self
    {
        self::$file = $file;
        return new self;
    }

    public function getFile()
    {
        return self::$file;
    }

    public function setExclusiveDirectory($exclusiveDirectory): self
    {
        self::$exclusiveDirectory = $exclusiveDirectory;
        return new self;
    }

    public function getExclusiveDirectory(): string
    {
        return self::$exclusiveDirectory;
    }

    public function setFileName($fileName): self
    {
        self::$fileName = $fileName;
        return new self;
    }

    public function getFileName()
    {
        return self::$fileName;
    }

    public function setFileFormat($fileFormat): self
    {
        self::$fileFormat = $fileFormat;
        return new self;
    }

    public function getFileFormat()
    {
        return self::$fileFormat;
    }

    public function setFileSize($fileSize): self
    {
        self::$fileSize = $fileSize;
        return new self;
    }

    public function getFileSize()
    {
        return self::$fileSize;
    }

    public function setFileType($fileType): self
    {
        self::$fileType = $fileType;
        return new self;
    }

    public function getFileType() 
    {
        return self::$fileType;
    }

    public function setFileDirectory($fileDirectory): self
    {
        self::$fileDirectory = $fileDirectory;
        return new self;
    }

    public function getFileDirectory() 
    {
        return self::$fileDirectory;
    }

    public function setFinalFileDirectory($finalFileDirectory): self
    {
        self::$finalFileDirectory = $finalFileDirectory;
        return new self;
    }

    public function getFinalFileDirectory() 
    {
        return self::$finalFileDirectory;
    }

    public function setFinalFileName($finalFileName): self
    {
        self::$finalFileName = $finalFileName;
        return new self;
    }

    public function getFinalFileName() 
    {
        return self::$finalFileName;
    }

    public function getFileAddress()
    {
        return $this->getFinalFileDirectory() . DIRECTORY_SEPARATOR . $this->getFinalFileName();
    }

    public function checkDirectory($fileDirectory)
    {
        if (!file_exists($fileDirectory)) {
            mkdir($fileDirectory, 0777, true);
        }
    }

    protected function provider() :self
    {
        
        $this->getExclusiveDirectory() ?? $this->setExclusiveDirectory("file" . DIRECTORY_SEPARATOR . date("Y") . DIRECTORY_SEPARATOR . date("M") . DIRECTORY_SEPARATOR . date("d"));
        $this->getFileName() ?? $this->setFileName(time());
        $this->getFileFormat() ?? $this->setFileFormat(self::$file->extension());

        $finalFileDirectory = $this->getFileDirectory() == null ? $this->getExclusiveDirectory() : $this->getExclusiveDirectory() . DIRECTORY_SEPARATOR . $this->getFileDirectory();

        $this->setFinalFileDirectory($finalFileDirectory);


        $finalFileName = $this->getFileName() . "." . $this->getFileFormat();
        $this->setFinalFileName($finalFileName);

        $this->checkDirectory($finalFileDirectory);
        return new self;
    }
}