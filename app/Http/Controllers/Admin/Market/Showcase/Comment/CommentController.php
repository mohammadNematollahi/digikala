<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Comment;

use Illuminate\Http\Request;
use App\Models\Admin\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CommentRequest;

class CommentController extends Controller
{
    public function index()
    {
        return view("admin.market.showcase.comment.index");
    }

    public function show(Comment $comment)
    {
        $comment->seen = 1;
        $comment->save();
        return view("admin.market.showcase.comment.show" , compact("comment"));
    }

    public function response( CommentRequest $commentRequest , Comment $comment)
    {
        $inputs = $commentRequest->all();
        $inputs["author_id"] = 1;
        $inputs["parent_id"] = $comment->id;
        $inputs["commentable_id"] = $comment->commentable->id;
        $inputs["commentable_type"] = $comment->commentable_type;
        $inputs["approved"] = 1 ;
        Comment::create($inputs);
        return redirect()->route("admin.market.showcase.comment.index")->with(["success" => "کامنت شما به موفقیت ثبت شد"]);
    }
}
