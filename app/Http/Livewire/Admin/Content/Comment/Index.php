<?php

namespace App\Http\Livewire\Admin\Content\Comment;

use App\Models\Admin\Comment;
use App\Models\Admin\Content\Article;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $articles = Article::with("comments")->get();
        $comments = [];

        foreach($articles as $article){
            foreach($article->comments  as $comment){
                array_push($comments , $comment);
            }
        }

        return view('livewire.admin.content.comment.index' , compact("comments"));
    }

    public function approved(Comment $comment)
    {
        $approved = $comment->approved == 0 ? 1 : 0;
        $comment->update(["approved" => $approved]);
        $comment->save();
    }
}
