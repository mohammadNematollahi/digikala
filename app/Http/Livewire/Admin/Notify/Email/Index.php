<?php

namespace App\Http\Livewire\Admin\Notify\Email;

use App\Models\Admin\Notify\Email;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ["destroy"];
    public function render()
    {
        $emails = Email::latest()->get();
        return view('livewire.admin.notify.email.index' , compact("emails"));
    }

    public function status(Email $email)
    {
        $status = $email->status == 0 ? 1 : 0;
        $email->update(["status" => $status]);
        $email->save();
    }

    public function destroy(Email $email)
    {
        $email->delete();
        $email->save();
    }
}
