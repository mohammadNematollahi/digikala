<?php


namespace App\Http\Services\Image\Traits;

trait ImageToolService
{
    private static $image;
    private static $exclusiveDirectory;
    private static $imageDirectory;
    private static $imageName;
    private static $imageFormat;
    private static $finalImageDirectory;
    private static $finalImageName;

    private function setImage($image)
    {
        self::$image = $image;
    }

    private function getImage(){
        return self::$image;
    }
    private function setExclusiveDirectory($exclusiveDirectory)
    {
        self::$exclusiveDirectory = trim($exclusiveDirectory ,"/\\");
    }
    
    private function getExclusiveDirectory()
    {
       return self::$exclusiveDirectory;
    }

    private function setimageDirectory($imageDirectory)
    {
        self::$imageDirectory = trim($imageDirectory , "/\\");
    }
    private function getImageDirectory()
    {
        return self::$imageDirectory;
    }

    private function setImageName($imageName)
    {
        self::$imageName = $imageName;

    }
    private function getImageName()
    {
        return self::$imageName;
    }

    private function setImageFormat($imageFormat)
    {
        self::$imageFormat = $imageFormat;
    }

    private function getImageFormat()
    {
        return self::$imageFormat;
    }

    private function setFinalImageDirectory($finalImageDirectory)
    {
        self::$finalImageDirectory = $finalImageDirectory;
    }

    private function getFinalImageDirectory()
    {
        return self::$finalImageDirectory;

    }

    private function setFinalImageName($finalImageName)
    {
        self::$finalImageName = $finalImageName;
    }

    private function getFinalImageName()
    {
        return self::$finalImageName;
    }

    private function setOriginalName()
    {
        return !empty(self::$image) ? $this->setImageName(pathinfo(self::$image->getClientOriginalName() , PATHINFO_FILENAME )) : false;
        // $_FILES["image"]['name']
    }

    private function checkDirectory($fileDirectory)
    {
        if(!file_exists($fileDirectory)){
            mkdir($fileDirectory , 0777 , true);
        }
    }
    
    private function getImageAddress()
    {
        return self::$finalImageDirectory . DIRECTORY_SEPARATOR .self::$finalImageName;
    }

    protected function provider()
    {
        //set properties
        $this->getImageDirectory() ?? $this->setimageDirectory(date("Y") . DIRECTORY_SEPARATOR . date("M") . DIRECTORY_SEPARATOR . date("d"));
        $this->getImageName() ?? $this->setImageName(time());
        $this->getImageFormat() ?? $this->setImageFormat(self::$image->extension());


        // set final image directory
        $finalImageDirectory = empty($this->getExclusiveDirectory()) ? $this->getImageDirectory() : $this->getExclusiveDirectory() . DIRECTORY_SEPARATOR . $this->getImageDirectory();

        $this->setFinalImageDirectory($finalImageDirectory);

        //set final image name
        $this->setFinalImageName($this->getImageName() . "." . $this->getImageFormat());

        //check final image directory
        $this->checkDirectory($this->getFinalImageDirectory());

    }
    
}