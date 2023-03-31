<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleXMLElement;

class XMLToJSONResponseController extends Controller
{
    public function xmlToJson(Request $request)
    {
        $xml = file_get_contents(base_path('files/tasks.xml'));
        $data = new SimpleXMLElement($xml);
        $json = json_encode($data, JSON_PRETTY_PRINT);
        return response($json, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
