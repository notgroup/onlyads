<?php
use App\Models\LogHistory;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Laravel\Lumen\Application;
use Laravel\Lumen\Routing\UrlGenerator;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\DB;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Cache;

if (!function_exists('fbApiInit')) {
    function fbApiInit($bmId = 0)
    {
        $bmId = isset($_GET['bmId']) ? $_GET['bmId'] : $bmId;
        if ($bmId) {
            $tokens = DB::connection('facebook')->table('bm_accounts')->get()->keyBy('bm_id');
            
            
            $access_token = $tokens[$bmId]->access_token;
            $app_secret = $tokens[$bmId]->app_secret;
            $app_id = $tokens[$bmId]->app_id;
            $fb = new \Facebook\Facebook([
              'app_id' => $app_id,
              'app_secret' => $app_secret,
              'default_graph_version' => 'v7.0',
              'default_access_token' => $access_token,
              //'persistent_data_handler' => 'session',
              //'cookie' => TRUE, // optional
            ]);
            }

    }
}
if (!function_exists('cargoDateFormat')) {
    function cargoDateFormat($stringDate)
    {
      /*
        $date = date_create('2000-01-01');
        if (!$date) {}
        echo date_format($date, 'Y-m-d');
        */


        if (strpos($stringDate, ':00')) {
            return null;
        } else {

            $time = strtotime($stringDate);
            return date("Y-m-d", $time);
        }

    }
}
if (!function_exists('generateCsv')) {
    function generateCsv($fileName, $data = [], $delimiter = ',', $enclosure = '"')
    {

        $handle = fopen($fileName, 'w');
        foreach ($data as $lkey => $line) {
                fputcsv($handle, array_values($line), $delimiter, $enclosure);
        }
        fclose($handle);

    }
}
if (!function_exists('addLogHistory')) {
    function addLogHistory($data)
    {
$where = [
    'subject_id'  => $data['subject_id'],
    'object_id'   => $data['object_id'],
    'log_type'    => $data['log_type'],
    'action_type' => $data['action_type'],
];
        $log = LogHistory::create($data);
        return $log;

    }
}
if (!function_exists('get_web_page_header')) {
    function get_web_page_header($url)
    {
        $res     = array();
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER         => false, // do not return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT        => 120, // timeout on response
            CURLOPT_MAXREDIRS      => 10, // stop after 10 redirects
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err     = curl_errno($ch);
        $errmsg  = curl_error($ch);
        $header  = curl_getinfo($ch);
        curl_close($ch);

        //$res['content'] = $content;
        $res['url']            = $header['url'];
        $res['redirect_count'] = $header['redirect_count'];
        $res['errmsg']         = $errmsg;
        $res['err']            = $err;
        return $res;
    }
}

if (!function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string  $path
     * @return string
     */
    function public_path($path = '')
    {
        return rtrim(app()->basePath('public/' . $path), DIRECTORY_SEPARATOR);
    }
}
if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string  $path
     * @return string
     */
    function config_path($path = '')
    {
        return rtrim(app()->basePath('config/' . $path), DIRECTORY_SEPARATOR);
    }
}
if (!function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return \Illuminate\Support\HtmlString
     *
     * @throws \Exception
     */
    function mix($path, $manifestDirectory = '')
    {
        static $manifests = [];
        if (!starts_with($path, '/')) {
            $path = "/{$path}";
        }
        if ($manifestDirectory && !starts_with($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }
        $manifestKey = $manifestDirectory ? $manifestDirectory : '/';
        if (file_exists(public_path($manifestDirectory . 'hot'))) {
            return new HtmlString("//localhost:8080{$path}");
        }
        if (in_array($manifestKey, $manifests)) {
            $manifest = $manifests[$manifestKey];
        } else {
            if (!file_exists($manifestPath = public_path($manifestDirectory . '/mix-manifest.json'))) {
                throw new Exception('The Mix manifest does not exist.');
            }
            $manifests[$manifestKey] = $manifest = json_decode(
                file_get_contents($manifestPath), true
            );
        }
        if (!array_key_exists($path, $manifest)) {
            throw new Exception(
                "Unable to locate Mix file: {$path}. Please check your " .
                'webpack.mix.js output paths and try again.'
            );
        }
        return new HtmlString($manifestDirectory . $manifest[$path]);
    }
}
if (!function_exists('auth')) {
    /**
     * Get the available auth instance.
     *
     * @param  string|null  $guard
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    function auth($guard = null)
    {
        if (is_null($guard)) {
            return app(AuthFactory::class);
        }
        return app(AuthFactory::class)->guard($guard);
    }
}
if (!function_exists('abort_if')) {
    /**
     * Throw an HttpException with the given data if the given condition is true.
     *
     * @param  bool    $boolean
     * @param  int     $code
     * @param  string  $message
     * @param  array   $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function abort_if($boolean, $code, $message = '', array $headers = [])
    {
        if ($boolean) {
            abort($code, $message, $headers);
        }
    }
}
if (!function_exists('abort_unless')) {
    /**
     * Throw an HttpException with the given data unless the given condition is true.
     *
     * @param  bool    $boolean
     * @param  int     $code
     * @param  string  $message
     * @param  array   $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function abort_unless($boolean, $code, $message = '', array $headers = [])
    {
        if (!$boolean) {
            abort($code, $message, $headers);
        }
    }
}
if (!function_exists('bcrypt')) {
    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    function bcrypt($value, $options = [])
    {
        return app('hash')->make($value, $options);
    }
}
if (!function_exists('cookie')) {
    /**
     * Create a new cookie instance.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  int  $minutes
     * @param  string  $path
     * @param  string  $domain
     * @param  bool  $secure
     * @param  bool  $httpOnly
     * @param  bool  $raw
     * @param  string|null  $sameSite
     * @return \Illuminate\Cookie\CookieJar|\Symfony\Component\HttpFoundation\Cookie
     */
    function cookie($name = null, $value = null, $minutes = 0, $path = null, $domain = null, $secure = false, $httpOnly = true, $raw = false, $sameSite = null)
    {
        list($path, $domain, $secure, $sameSite) = [$path, $domain, $secure, $sameSite];
        $time                                    = ($minutes == 0) ? 0 : Carbon::now()->addSeconds($minutes * 60)->getTimestamp();
        return new Cookie($name, $value, $time, $path, $domain, $secure, $httpOnly, $raw, $sameSite);
    }
}
if (!function_exists('policy')) {
    /**
     * Get a policy instance for a given class.
     *
     * @param object|string $class
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    function policy($class)
    {
        return app(Gate::class)->getPolicyFor($class);
    }
}
if (!function_exists('report')) {
    /**
     * Report an exception.
     *
     * @param  \Exception $exception
     *
     * @return void
     */
    function report($exception)
    {
        if ($exception instanceof Throwable &&
            !$exception instanceof Exception) {
            $exception = new FatalThrowableError($exception);
        }
        app(ExceptionHandler::class)->report($exception);
    }
}
if (!function_exists('action')) {
    /**
     * Generate the URL to a controller action.
     *
     * @param string $name
     * @param array $parameters
     * @param bool $absolute
     *
     * @return string
     */
    function action($name, $parameters = [], $absolute = true)
    {
        /** @var Application $app */
        $app     = app();
        $matches = [];
        if (preg_match('/Lumen \(([0-9\.]+)\)/', $app->version(), $matches)) {
            $version = floatval(trim($matches[1]));
            if (5.5 <= $version) {
                $routes = app('router')->getRoutes();
            } else {
                $routes = $app->getRoutes();
            }
        } else {
            $routes = $app->getRoutes();
        }
        foreach ($routes as $route) {
            $uri    = $route['uri'];
            $action = $route['action'];
            if (isset($action['uses'])) {
                if ($action['uses'] === $name) {
                    $uri = preg_replace_callback('/\{(.*?)(:.*?)?(\{[0-9,]+\})?\}/', function ($m) use (&$parameters) {
                        return isset($parameters[$m[1]]) ? array_pull($parameters, $m[1]) : $m[0];
                    }, $uri);
                    $uri = with(new UrlGenerator($app))->to($uri, []);
                    if (!$absolute) {
                        $root = $app->make('request')->root();
                        if (starts_with($uri, $root)) {
                            $uri = Str::substr($uri, Str::length($root));
                            if (empty($uri)) {
                                $uri = '/';
                            }
                        }
                    }
                    if (!empty($parameters)) {
                        $uri .= '?' . http_build_query($parameters);
                    }
                    return $uri;
                }
            }
        }
        throw new InvalidArgumentException("Action {$name} not defined.");
    }
}
if (!function_exists('app_with')) {
    /**
     * Get the available container instance.
     *
     * @param string $abstract
     * @param array $parameters
     *
     * @return mixed|Application
     */
    function app_with($abstract = null, array $parameters = [])
    {
        /** @var Application $app */
        $app = Application::getInstance();
        if (is_null($abstract)) {
            return $app;
        }
        if (method_exists($app, 'makeWith')) {
            return empty($parameters)
            ? $app->make($abstract)
            : $app->makeWith($abstract, $parameters);
        } else {
            return $app->make($abstract, $parameters);
        }
    }
}
if (!function_exists('asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool $secure
     *
     * @return string
     */
    function asset($path, $secure = null)
    {
        return (new UrlGenerator(app()))->to($path, null, $secure);
    }
}
if (!function_exists('back')) {
    /**
     * Create a new redirect response to the previous location.
     *
     * @param int $status
     * @param array $headers
     * @param mixed $fallback
     *
     * @return RedirectResponse
     */
    function back($status = 302, $headers = [], $fallback = false)
    {
        return redirect()->back($status, $headers, $fallback);
    }
}
if (!function_exists('cache')) {
    /**
     * Get / set the specified cache value.
     *
     * If an array is passed, we'll assume you want to put to the cache.
     *
     * @param dynamic key|key,default|data,expiration|null
     *
     * @return mixed
     *
     * @throws \Exception
     */
    function cache()
    {
        $arguments = func_get_args();
        if (empty($arguments)) {
            return app('cache');
        }
        if (is_string($arguments[0])) {
            return app('cache')->get($arguments[0], isset($arguments[1]) ? $arguments[1] : null);
        }
        if (!is_array($arguments[0])) {
            throw new Exception(
                'When setting a value in the cache, you must pass an array of key / value pairs.'
            );
        }
        if (!isset($arguments[1])) {
            throw new Exception(
                'You must specify an expiration time when setting a value in the cache.'
            );
        }
        return app('cache')->put(key($arguments[0]), reset($arguments[0]), $arguments[1]);
    }
}
if (!function_exists('logger')) {
    /**
     * Log a debug message to the logs.
     *
     * @param null $message
     * @param array $context
     *
     * @return Log|null
     */
    function logger($message = null, array $context = [])
    {
        if (is_null($message)) {
            return app('log');
        }
        return app('log')->debug($message, $context);
    }
}
if (!function_exists('method_field')) {
    /**
     * Generate a form field to spoof the HTTP verb used by forms.
     *
     * @param $method
     *
     * @return HtmlString
     */
    function method_field($method)
    {
        return new HtmlString('<input type="hidden" name="_method" value="' . $method . '" />');
    }
}
if (!function_exists('validator')) {
    /**
     * Create a new Validator instance.
     *
     * @param  array $data
     * @param  array $rules
     * @param  array $messages
     * @param  array $customAttributes
     *
     * @return Validator|ValidationFactory
     */
    function validator(array $data = [], array $rules = [], array $messages = [], array $customAttributes = [])
    {
        /** @var ValidationFactory $factory */
        $factory = app(ValidationFactory::class);
        if (func_num_args() === 0) {
            return $factory;
        }
        return $factory->make($data, $rules, $messages, $customAttributes);
    }
}
if (!function_exists('request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param  array|string  $key
     * @param  mixed   $default
     * @return \Illuminate\Http\Request|string|array
     */
    function request($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('request');
        }
        if (is_array($key)) {
            return app('request')->only($key);
        }
        $value = app('request')->__get($key);
        return is_null($value) ? value($default) : $value;
    }
}

function convert($size)
{
    //convert(memory_get_usage())
    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
}

function slug_create($text = "", $separator = '-')
{

    //değiştirelecek türkçe karakterler
    $find    = array('ç', 'Ç', 'ı', 'İ', 'ş', 'Ş', 'ğ', 'Ğ', 'ö', 'Ö', 'ü', 'Ü');
    $replace = array('c', 'c', 'i', 'i', 's', 's', 'g', 'g', 'o', 'o', 'u', 'u');
    //türkçe karakterleri değiştirir
    $text = str_replace($find, $replace, $text);
    //tüm karakterleri küçüklür
    $text = mb_strtolower($text, 'UTF-8');
    // a'dan z'ye olan harfler, 0'dan 9 a kadar sayılar, tire (-),
    // boşluk ve altçizgi (_) dışındaki tüm karakteri siler
    $text = preg_replace('#[^-a-zA-Z0-9_ ]#', '', $text);
    //cümle aralarındaki fazla boşluğü kaldırır
    $text = trim($text); //cümle aralarındaki
    //boşluğun yerine tire (-) koyar
    $text = preg_replace('#[-_ ]+#', $separator, $text);

    return $text;
}

function slugify($text)
{
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
}

function generate_unique_number($from = 1000000, $to = 9999999)
{
    $generated_number = mt_rand($from, $to) + strtotime(date(now()));
    return (int) round($generated_number);
}

function custom_carbon_calculate_age($date)
{
    if (Helper::custom_check_empty($date) !== false) {
        return Carbon::parse($date)->age;
    }
    return false;
}

function getCurl($url = '', $headers = [], $post = 0, $filepath = 'content.txt')
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_TIMEOUT, 360);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    if ($post) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($curl, CURLOPT_USERAGENT, 'SeanPeterson');
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

    $headers1 = [];

    $content = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }

    $filepath = date('Y_m_d_H_i') . '_' . $filepath;

    file_put_contents('logs/'.$filepath, $content);

    return $content;
}

if (!function_exists('file_post_contents')) {
    function file_post_contents($url, $data, $contentType = 'json')
    {

        if ($contentType == 'x-www-form-urlencoded') {
            $content = http_build_query($data, '', '&');
        } else {
            $content = json_encode($data);
        }

        $header = array(
            "Content-Type: application/json",
            "Content-Length: " . strlen($content),
        );
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => $content,
                'header'  => implode("\r\n", $header),
            ),

        );
        return file_get_contents($url, false, stream_context_create($options));
    }
}
