<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parser\StartRequest;
use App\UseCases\Store\ParserService;
use App\Entity\Store\Provider\Provider;

class ImportController extends Controller
{
    private $parser;

    public function __construct(ParserService $parser)
    {
        $this->parser = $parser;
    }

    public function index()
    {
        $providers = Provider::all();
        return view('admin.parser.index', compact('providers'));
    }

    public function start()
    {
        $this->parser->start();
    }
}
