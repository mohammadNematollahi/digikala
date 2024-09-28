<?php

namespace App\Http\Livewire\Admin\Notify\Sms;

use Livewire\Component;
use App\Models\Admin\Notify\SMS;

class Index extends Component
{
    protected $listeners = ["destroy"];

    public function render()
    {
        $sms = SMS::latest()->get();
        return view('livewire.admin.notify.sms.index' , compact("sms"));
    }

    public function status(SMS $sMS)
    {
        $status = $sMS->status == 0 ? 1 : 0;
        $sMS->update(["status" => $status]);
        $sMS->save();
    }

    public function destroy(SMS $sMS)
    {
        $sMS->delete();
        $sMS->save();
    }
}
