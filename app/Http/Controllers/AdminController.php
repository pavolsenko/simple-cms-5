<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\View\Factory as View;

class AdminController extends Controller
{

    protected $view;


    public function __construct(View $view) {
        $this->view = $view;
    }

    public function index()
    {
        return $this->view->make('admin/dashboard');
    }

}