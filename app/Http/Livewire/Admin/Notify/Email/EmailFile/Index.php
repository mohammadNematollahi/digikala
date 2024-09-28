<?php

namespace App\Http\Livewire\Admin\Notify\Email\EmailFile;

use App\Models\Admin\Notify\Email;
use Livewire\Component;

class Index extends Component
{
    public Email $email;
    public function render()
    {
        return view('livewire.admin.notify.email.email-file.index');
    }
}
