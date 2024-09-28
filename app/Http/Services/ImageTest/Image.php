<?php
namespace App\Http\Services\ImageTest;

use App\Http\Services\ImageTest\CallMethod;
use App\Http\Services\ImageTest\ImageToolsService;
use Intervention\Image\Facades\Image as ImagePackage;

class Image
{
    use ImageToolsService , CallMethod;

    public function save()
    {
        //set name image
        $this->getImage();

        // listener provider
        $this->provider();

        if ($this->getImageFormat() == "gif") {
            copy($this->getImage(), public_path($this->getImageAddress()));
            return $this->getImageAddress();
        }

        $result = ImagePackage::make(self::$image->getRealPath())->save(public_path($this->getImageAddress()), null, $this->getImageFormat());

        return $result ? $this->getImageAddress() : false;
    }
}