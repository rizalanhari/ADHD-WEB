<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class adminController extends Controller
{
    public function index()
    {
        return view('admin.home');
        // return view('login.main');
    }
    public function data()
    {
        $dataTrain = Http::get('https://adhd-api.herokuapp.com/datatrain');
        $dataTrain = json_decode($dataTrain, true);
        $dataTest = Http::get('https://adhd-api.herokuapp.com/datatest');
        $dataTest = json_decode($dataTest, true);
        return view('admin.data')->with('dataTrain', $dataTrain)->with('dataTest', $dataTest);
    }
    public function predict()
    {
        return view('admin.predict');
    }
    public function storepredict(Request $request)
    {
        set_time_limit(1000);
        $response = Http::get('https://adhd-api.herokuapp.com/predictA', [
            'train' => $request->input('train'),
            'test' => $request->input('test'),
            'lrate' => $request->input('lrate'),
            'neuronh' => $request->input('neuronh'),
        ]);
        $response = json_decode($response, true);
        // dd($response);
        return view('admin.result')->with('result', $response);
    }
}
