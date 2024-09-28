<?php

namespace App\Http\Livewire\Admin\Market\Discount\Common;

use App\Models\Admin\Market\CommonDiscount;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ["destroy"];

    public function render()
    {
        $commons = CommonDiscount::orderBy("end_date" , "desc")->get();
        return view('livewire.admin.market.discount.common.index' , compact("commons"));
    }

    public function status(CommonDiscount $commonDiscount)
    {
        $status = $commonDiscount->status == 0 ? 1 : 0;
        $commonDiscount->update(["status" => $status]);
    }

    public function destroy(CommonDiscount $commonDiscount)
    {
        $commonDiscount->delete();
    }
}
