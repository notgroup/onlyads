<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct()
    {

    }


    public function handle($request, Closure $next) {
        $allowedOrigins = [
            "http://notgroupgithubio.test",
            "http://127.0.0.1",
        ];
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : 0;
        
        //if (in_array($origin, $allowedOrigins)) {
        if ($origin) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $origin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'))
                ->header('Access-Control-Allow-Credentials',' true');
        }
        return $next($request);
    }
    public function handle2($request, Closure $next) {

        // ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Headers' => 'Origin, Content-Type'
        ];

        if ($request->getMethod() != "OPTIONS") {
            return $next($request);
        }

        $response = $next($request);

        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }

    public function handle3($request, Closure $next)
    {

        if ($request->isMethod('OPTIONS')) {

            $response = response()->json([], 200);

        } else {
            $response = $next($request);

        }


        $origins = [
            "http://liberyen.test",
            "http://karsilastirma01.test",
            "http://127.0.0.1",
            "http://127.0.0.1:5500",
            "https://www.fiyat360.com",
            "https://fiyat360.com",
            "http://fiyat360.test",
        ];



    if($request->headers->get('origin') && in_array($request->headers->get('origin'), $origins)){
        $response->header('Access-Control-Allow-Origin', $request->headers->get('origin'));
    }

    $response->header('Access-Control-Allow-Methods', 'HEAD, GET, OPTIONS, POST, PUT, PATCH, DELETE');
    $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));

    return $response;
}
}
