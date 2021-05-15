<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Orbitali;
use Illuminate\Http\Request;
use Orbitali\Console\ControllerMakeCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\Filesystem;

class DefaultController extends Controller
{
    private $orbitali;
    private $request;
    private $files;

    public function __construct(
        Orbitali $orbitali,
        Request $request,
        Filesystem $files
    ) {
        $this->orbitali = $orbitali;
        $this->request = $request;
        $this->files = $files;
    }

    private function isPost()
    {
        return $this->request->isMethod(Request::METHOD_POST);
    }

    public function __call($method, $arguments)
    {
        if ($this->isPost()) {
            Artisan::call(ControllerMakeCommand::class, [
                "name" => $this->orbitali->class,
                "--type" => $this->orbitali->class,
                "-m" => $method,
            ]);
            return redirect($this->request->getPathInfo());
        }
        $this->orbitali->method = $method;
        return response()->view("Orbitali::setup.default", [], 404);
    }
}
