<?php

namespace App\Http\Controllers;

use App\Http\Filters\CommentFilter;
use App\Services\CommentService;

class BaseController extends Controller
{
    public $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }
}
