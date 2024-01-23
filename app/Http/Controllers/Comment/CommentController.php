<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\FilterRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\DB;


class CommentController extends BaseController
{
    public function index(FilterRequest $request): View
    {
        $comments = $this->service
            ->sortComments($request);
        $post = DB::table('posts')
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->select("posts.text", "users.name", "posts.created_at")
            ->get()->first();
        if ($comments === null)
        {
            $comments = Comment::paginate(25);
        }
        return view("comments.index",
            compact("comments", "post"));
    }

    public function store(StoreRequest $request)
    {
        $this->service->store($request);
        return redirect()->back()->with("success", "Комментарий был успешно добавлен");
    }
}
