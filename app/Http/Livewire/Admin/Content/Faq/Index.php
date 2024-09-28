<?php

namespace App\Http\Livewire\Admin\Content\Faq;

use Livewire\Component;
use App\Models\Admin\Content\FAQ;

class Index extends Component
{
    protected $listeners = ["destroy"];
    public function render()
    {
        $faqs = FAQ::latest()->get();
        return view('livewire.admin.content.faq.index' , compact("faqs"));
    }

    public function status(FAQ $fAQ)
    {
        $status = $fAQ->status == 0 ? 1 : 0;
        $fAQ->update(["status" => $status]);
        $fAQ->save();
    }

    public function destroy(FAQ $fAQ)
    {
        $fAQ->delete();
        $fAQ->save();
    }
}
