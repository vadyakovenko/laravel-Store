<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Store\Import\ImportService;
use App\Entity\Store\Provider\Provider;

class ImportController extends Controller
{
    private $import;

    public function __construct(ImportService $import)
    {
        $this->import = $import;
    }

    public function index()
    {
        $providers = Provider::all();
        return view('admin.parser.index', compact('providers'));
    }

    public function start(Provider $provider)
    {
        try {
            $this->import->start($provider);
        } catch(\RuntimeException $e) {
            echo $e->getMessage();die;
        } catch(\DomainException $e) {
            echo $e->getMessage();die;
        }

        return 'OK!';
    }
}
