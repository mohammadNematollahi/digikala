<?php

namespace App\Http\Livewire\Admin\Content\Article;

use App\Models\Admin\Content\Article;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['destroy'];
    public function render()
    {
        $articles = Article::latest()->get();
        return view('livewire.admin.content.article.index' , compact("articles"));
    }

    public function destroy(Article $postCategory)
    {
        $postCategory->delete();
        $postCategory->save();
    }
    public function status(Article $postCategory)
    {
        $status = $postCategory->status == 0 ? 1 : 0;
        $postCategory->update(["status" => $status]);
        $postCategory->save();
    }
}
