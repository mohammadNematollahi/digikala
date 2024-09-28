<?php

namespace App\Http\Livewire\Admin\Market\Showcase\Banner;

use Livewire\Component;
use App\Models\Admin\Market\Banner;
use App\Http\Services\Image\ImageService;

class Index extends Component
{

    protected $listeners = ['destroy'];

    public function render()
    {
        $banners = Banner::orderBy("position" , "desc")->get();
        return view('livewire.admin.market.showcase.banner.index' , compact("banners"));
    }

    public function status(Banner $banner)
    {
        $status = $banner->status == 0 ? 1 : 0;
        $banner->update(["status" => $status]);
    }
    
    public function destroy(Banner $banner)
    {
        ImageService::deleteImage($banner->image);
        $banner->delete();
    }
}
