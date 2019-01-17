<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parser\StartRequest;
use App\UseCases\Store\ParserService;

class ParserController extends Controller
{
    private $parser;

    public function __construct(ParserService $parser)
    {
        $this->parser = $parser;
    }

    public function index()
    {
        return view('admin.parser.index');
    }

    public function start()
    {
        $this->parser->start();
    }
}
