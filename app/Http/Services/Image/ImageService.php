<?php

namespace App\Http\Services\Image;

use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use App\Http\Services\Image\Traits\CallMethod;
use App\Http\Services\Image\Traits\ImageToolService;

class ImageService
{
    use ImageToolService , CallMethod;

    protected function save($image)
    {
        //set name image
        $this->setImage($image);
        //setting provider

        $this->provider();
        //save image

        if($this->getImageFormat() == "gif"){
            copy( $this->getImage() , public_path($this->getImageAddress()));
            return  $this->getImageAddress();
        }

        $result = Image::make($image->getRealPath())->save(public_path($this->getImageAddress()) , null , $this->getImageFormat());

        return $result ? $this->getImageAddress() : false;
    }

    protected function saveGif($gif)
    {
        //set name image
        $this->setImage($gif);
        //setting provider

        $this->provider();
        //save image
        
        $result = copy( $this->getImage() , public_path($this->getImageAddress()));

        return $result ? $this->getImageAddress() : false;
    }

    protected function resizeAndSave($image , $width , $height){
        //set name image
        $this->setImage($image);
        //setting provider

        $this->provider();

        //save image

        $result = Image::make($image->getRealPath())->fit($width , $height)->save(public_path($this->getImageAddress()) , null , $this->getImageFormat());

        return $result ? $this->getImageAddress() : false;
    }
    
    protected function createIndexAndSave($image){

        //get data from config
        $imageSizes = Config::get("imag.index-image-size");

        //set image
        $this->setImage($image);

        //set directory
        $this->getImageDirectory() ?? $this->setImageDirectory(date("Y") . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
        $this->setImageDirectory($this->getImageDirectory() . DIRECTORY_SEPARATOR . time());
        
        //set name
        $this->getImageName() ?? $this->setImageName(time());
        $imageName = $this->getImageName();

        $imageIndex = [];
        foreach($imageSizes as $key => $value){

            //set full image name
            $currentImageName = $imageName . "_" . $key;
            $this->setImageName($currentImageName);

            //use provider
            $this->provider();

            //save images
            $result = Image::make($image->getRealPath())->fit($imageSizes['width'] , $imageSizes['height'])->save(public_path
            ($this->getImageAddress()) , null , $this->getImageFormat());

            if($result){
                $imageIndex[$key] = $this->getImageAddress();
            }else{
                return false;
            }

        }

        $images["indexArray"] = $imageIndex;
        $images["directory"] = $this->getFinalImageDirectory();
        $images["currentImage"] = Config::get('image.default-current-index-image');

        return $images;
        
    }

    protected function deleteImage($path){
        if(file_exists($path))
        {
            unlink($path);
        }
        return false;
    }

    protected function deleteImageIndex($images){
        $directory = public_path($images['directory']);
        $this->deleteDirectoryAndFiles($directory);
    }


    protected function deleteDirectoryAndFiles($directory)
    {

        if(!is_dir($directory)){
            return false;
        }

        $files = glob($directory . DIRECTORY_SEPARATOR . "*" , GLOB_MARK);
        foreach($files as $file){
            if(is_dir($file)){
                $this->deleteDirectoryAndFiles($file);
            }else{
                unlink($file);
            }
        }

        $final = rmdir($directory);
        return $final;
    }
}
