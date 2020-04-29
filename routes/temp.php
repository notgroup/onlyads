<?php
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

$router->get('/BlogList', function (Request $request) use ($router) {
    // DB::connection('blog')->table('settings')->insert($requestAll);
    //DB::connection('facebook')->table('settings')->get()->toArray();
     return response()->json([]);
   
   });