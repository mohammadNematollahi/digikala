<?php

namespace App\Http\Livewire\Admin\Market\Delivery;

use App\Models\Admin\Market\Delivery;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ["destroy"];
    public function render()
    {
        $deliveries = Delivery::latest()->get();   
        return view('livewire.admin.market.delivery.index' , compact("deliveries"));
    }

    public function status(Delivery $delivery)
    {
        $status = $delivery->status == 0 ? 1 : 0;
        $delivery->update(["status" => $status]);
        $delivery->save();
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        $delivery->save();
    }
}
