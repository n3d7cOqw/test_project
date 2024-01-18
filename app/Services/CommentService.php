<?php

namespace App\Services;

use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\FilterRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;

class CommentService
{
        public function sortComments(FilterRequest $request)
        {
            if (isset($request->date_asc)){
                $comments = Comment::query()->orderBy("created_at")->paginate(25);

            }
            if (isset($request->date_desc)){
                $comments = Comment::query()->orderBy("created_at", "desc")->paginate(25);


            }
            if (isset($request->username_desc)){
                $comments = Comment::query()->orderBy("name", "desc")->paginate(25);

            }
            if (isset($request->username_asc)){
                $comments = Comment::query()->orderBy("name")->paginate(25);
            }
            return $comments ?? null;

        }

        public function store(StoreRequest $request)
        {
            $text = $request->validated();
            $text["text"] = Purifier::clean($request->input('text'), ['HTML.Allowed' => 'a[href|title],code,i,strong']);
            $comment = new Comment;
            $comment->user_id = auth()->id();
            $comment->name = auth()->user()->name;
            $comment->captcha = $text["captcha"];
//            $comment->parent_id =
            $comment->home_page = auth()->user()->name;
            $comment->text = $text["text"];

            if ($request->hasFile("picture")){
                $picture =  $request->file("picture")->storeAs("public/pictures", time() . "." . $request->file("picture")->extension());
                $comment->photo = $picture;
            }
            $comment->save();
        }
}
