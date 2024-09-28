<?php

namespace App\Http\Livewire\Admin\Market\Showcase\Comment;

use App\Models\Admin\Market\Product;
use Livewire\Component;
use App\Models\Admin\Comment;

class Index extends Component
{
    public function render()
    {
        $products = Product::with(["comments"])->get();

        $comments = [];

        foreach($products as $article){
            foreach($article->comments  as $comment){
                array_push($comments , $comment);
            }
        }
        
        return view('livewire.admin.market.showcase.comment.index' , compact("comments"));
    }

    public function approved(Comment $comment)
    {
        $approved = $comment->approved == 0 ? 1 : 0;
        $comment->update(["approved" => $approved]);
        $comment->save();
    }
}
