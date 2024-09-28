<?php

namespace App\Http\Livewire\Admin\Market\Discount\Copan;

use App\Models\Admin\Market\Copan;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ["destroy"];
    public function render()
    {
        $copans = Copan::orderBy("end_date" , "desc")->get();
        return view('livewire.admin.market.discount.copan.index' , compact("copans"));
    }

    public function status(Copan $copan)
    {
        $status = $copan->status == 0 ? 1 : 0;
        $copan->update(["status" => $status]);
    }

    public function destroy(Copan $copan)
    {
        $copan->delete();
    }
}
