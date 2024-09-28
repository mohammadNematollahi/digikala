<?php

namespace App\Http\Livewire\Admin\Market\Discount\AmazingSale;

use App\Models\Admin\Market\AmazingSale;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ["destroy"];
    public function render()
    {
        $amazing_sales = AmazingSale::orderBy("end_date" , "desc")->get();
        return view('livewire.admin.market.discount.amazing-sale.index' , compact("amazing_sales"));
    }

    public function status(AmazingSale $amazingSale)
    {
        $status = $amazingSale->status == 0 ? 1 : 0;
        $amazingSale->update(["status" => $status]);
    }

    public function destroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
    }
}
