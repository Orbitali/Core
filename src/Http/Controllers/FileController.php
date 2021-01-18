<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function upload(Request $request)
    {
        $file = $request->file("file");
        $path = $file->storePubliclyAs(
            date("Y/m"),
            time() . "_" . $file->getClientOriginalName(),
            ["disk" => "public"]
        );

        return response($path, 200);
    }
}
