<?php
// ExampleController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function receiveData(Request $request)
    {
        // Retrieve data from URL parameter
        $data = $request->route('data');

        // Retrieve data from query parameter
        // $data = $request->input('data');

        return view('example', ['receivedData' => $data]);
    }
}
