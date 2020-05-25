<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentMeta;
use App\Models\EavAttribute;
use App\Models\EavGroup;
use App\Models\Entities;
use App\Models\TermVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ContentController extends Controller
{
    public function getSearchEntity(Request $request)
    {
        $contents = [];
        $facets   = [];
        $filter   = [];
        if ($request->has('filter')) {

            $filter = $request->get('filter');
            if (isset($filter['content_type']) && $filter['content_type']) {
                $contents = Content::where('entity_type_id', $filter['content_type']);
                $facets   = Content::select('entity_status', \DB::raw('count(*) as total'))->where('entity_type_id', $filter['content_type'])->groupBy('entity_status')->get()->pluck('total', 'entity_status');
            }
            if (isset($filter['status']) && $filter['status']) {
                $contents->where('entity_status', $filter['status']);
            }
            if (isset($filter['startDate']) && $filter['startDate']) {
                $contents->whereDate('created_at', '>=', $filter['startDate']);
            }
            if (isset($filter['endDate']) && $filter['endDate']) {
                $contents->whereDate('created_at', '<=', $filter['endDate']);
            }
            if (isset($filter['city']) && $filter['city']) {
                $contents->where('meta->city', $filter['city']);
            }
            if (isset($filter['payment_method']) && $filter['payment_method']) {
                $contents->where('meta->payment_method', $filter['payment_method']);
            }
        }

        //$request->get('filter')
        $response = [];
        $contents = $contents->orderBy('content_id', 'desc');
        if (isset($filter['download']) && $filter['download']) {
            if ($request->has('selecteds') && $request->get('selecteds')) {
                $contents->whereIn('content_id', $request->get('selecteds'));
            }
            return $this->saveAsCsvKeywords('yedek', $contents->get()->toArray());
        } else {
            $contents           = $contents->simplePaginate(100)->toArray();
            $contents['facets'] = $facets;
            $response           = $contents;
        }

        //->limit(100)->get()->toArray();
        return response()->json($response);
    }

    public function saveAsCsvKeywords($fileName, $data)
    {

        $cities          = DB::table('zone')->get()->keyBy('zone_id');
        $towns           = DB::table('town')->get()->keyBy('town_id');
        $paymentMethods  = Content::where('entity_type_id', 35)->get()->keyBy('content_id');
        $shipmentMethods = Content::where('entity_type_id', 36)->get()->keyBy('content_id');

        $newData     = [];
        $defaultKeys = ["mok", "urun", "ad", "adres", "ilce", "sehir", "tel", "irsaliyeno", "ilkodu", "ilcekodu", "varis", "serino", "desi", "tahsilat_tutari", "odeme_tipi"];
        $exampleItem = array_fill_keys(array_values($defaultKeys), null);
        foreach ($data as $key => $preItem) {
            $preItem                      = collect($preItem);
            $emptyItem                    = $exampleItem;
            $emptyItem["mok"]             = $preItem['content_id'];
            $emptyItem["urun"]            = array_values($preItem['meta']['products'])[0]['meta']['name'];
            $emptyItem["ad"]              = Str::title($preItem['meta']['fullname']);
            $emptyItem["adres"]           = $preItem['meta']['address'];
            $emptyItem["ilce"]            = isset($towns[$preItem['meta']['town']]) ? $towns[$preItem['meta']['town']]->name : $preItem['meta']['town'];
            $emptyItem["sehir"]           = $cities[$preItem['meta']['city']]->name;
            $emptyItem["tel"]             = $preItem['meta']['phone_number'];
            $emptyItem["irsaliyeno"]      = $preItem['content_id'];
            $emptyItem["ilkodu"]          = $cities[$preItem['meta']['city']]->code_number;
            $emptyItem["tahsilat_tutari"] = $preItem['meta']['finalPrice'];
            $emptyItem["odeme_tipi"]      = $paymentMethods[$preItem['meta']['payment_method']]->meta['name'];
            $emptyItem                    = array_map("trim", array_values($emptyItem));
            $newData[]                    = $emptyItem;
        }

        $fileName = 'assets/uploads/' . $fileName;
        $dt       = fopen($fileName . '.csv', 'w');
        fputcsv($dt, array_keys($exampleItem));
        foreach ($newData as $key => $item) {
            fputcsv($dt, $item);
        }

        fclose($dt);

        $spreadsheet = new Spreadsheet();
        $reader      = new \PhpOffice\PhpSpreadsheet\Reader\Csv();

        /* Set CSV parsing options */

        $reader->setDelimiter(',');
        $reader->setEnclosure('"');
        $reader->setSheetIndex(0);

        /* Load a CSV file and save as a XLS */

        $spreadsheet = $reader->load($fileName . '.csv');
        $writer      = new Xlsx($spreadsheet);
        $writer->save($fileName . '.xlsx');

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
        return response()->json(['url' => $fileName . '.xlsx']);
    }

    public function getContents(Request $request, $entity_type_id)
    {
        $contents = Content::where('entity_type_id', $entity_type_id);

        //$request->get('filter')
        $contents = $contents->orderBy('content_id', 'desc')->limit(100)->get()->toArray();
        return response()->json($contents);
    }
    public function setChangeStatus(Request $request, $entity_type_id)
    {
        $log = [];
        if ($request->has('selecteds')) {
            $status = '';
            $items = Content::where('entity_type_id', $entity_type_id)->whereIn('content_id', $request->get('selecteds'));
            if (strpos($request->get('newStatus'), ':')) {
                $statusParse    = explode(':', $request->get('newStatus'));
                $status = $statusParse[0];
                $updateArr = ['meta->shipment_id' => $statusParse[1], 'entity_status' => $status, 'meta->update_' . $status => date('Y-m-d H:i:s')];
            } else {
                $status = $request->get('newStatus');
                $updateArr = ['entity_status' => $status, 'meta->update_' . $status => date('Y-m-d H:i:s')];
            }
            $items->update($updateArr);
        }



        return response()->json($log);
    }
    public function addActionLog(Request $request)
    {
        
     
            $log = addLogHistory($request->all());
    
        return response()->json($request->all());
    }



    public function exportExcell(Request $request, $entity_type_id)
    {

        return response()->json($request->all());
    }
    public function getContent(Request $request, $content_id)
    {
        $content = Content::where('content_id', $content_id)
        //where('entity_type_id', $entity_type_id)
            ->first();
        return response()->json($content);
    }

    public function addContent(Request $request, $type_id)
    {

        if ($request->has('content_id')) {
            $request->merge([
                'meta' => array_merge($request->meta, [
                    'updated_ip' => $request->ip(),
                    'updated_' . $request->get('entity_status') => date('Y-m-d H:i:s'),
                ]),
            ]);
            $request->merge(['creator_id' => $request->user()->id]);
            Content::where(['content_id' => $request->input('content_id')])->update($request->all());
            $content = Content::find($request->input('content_id'));
        } else {
            $request->merge([
                'meta' => array_merge($request->meta, [
                    'updated_ip' => $request->ip(),
                ]),
            ]);
            if ($type_id == 33) {
                $hasOldOrder = 0;
                if (isset($request->meta['phone_number'])) {
                    $hasOldOrder = Content::where(['entity_type_id' => 33])->where('meta->phone_number', $request->meta['phone_number'])->count() ? 1 : 0;
                }
                $request->merge([
                    'meta' => array_merge($request->meta, [
                        'firstPrice'  => $request->meta['finalPrice'],
                        'ref'         => 0,
                        'locale'      => 'tr',
                        'firstUrl'    => 0,
                        'domain_name' => 0,
                        'hasOldOrder' => $hasOldOrder,
                        'referrerUrl' => 0,
                        'agentStatus' => 'processless',
                        'shipmentStatus' => 0,
                        'completed' => 0,
                        'agentNote'   => '',
                    ]),
                ]);
            }
            $contentAttr = [
                'entity_type_id' => $type_id,
                'creator_id'     => $request->user()->id,
                'parent_id'      => 0,
            ];
            $request->merge($contentAttr);
            $content = Content::create($request->all());
            // $entityContent   = ContentMeta::create(['content_id' => $entityContentId, 'attributes' => $request->all()]);
            // $content         = Content::find($entityContentId);

        }
        return response()->json($content);

    }
    public function addOrder(Request $request)
    {

        try {
            $hasOldOrder = 0;
            $phoneNumber = $request->has('phone_number') ? substr($request->get('phone_number'), -10) : 0;
            if ($phoneNumber) {
                $hasOldOrder = Content::where(['entity_type_id' => 33])->where('meta->phone_number', $phoneNumber)->count() ? 1 : 0;
            }
            $products = $request->has('product_id') ? Content::where('entity_type_id', 4)
                ->whereIn('content_id', $request->get('product_id'))
                ->get() : collect([]);
            $city = DB::table('zone')->where('name', $request->get('city'))->first();
            $town = DB::table('town')->where('zone_id', $city->zone_id)->where('name', $request->get('district'))->first();
            $request->merge([
                'fullname'     => $request->get('firstname') . ($request->has('lastname') ? ' ' . $request->get('lastname') : ''),
                'lastname'     => $request->get('lastname') ?: '',
                'phone_number' => $phoneNumber,
                'hasOldOrder'  => $hasOldOrder,
                'redirect'     => $request->get('success_url'),
                'client_ip'    => $request->ip(),
                'browser'      => $request->header('User-Agent'),
                'city'         => $request->has('city') ? $city->zone_id : 0,
                'town'         => $request->has('district') ? $town->town_id : 0,
                'products'     => $products->toArray(),
                'firstPrice'   => $products->sum('meta.price') ?: 0,
                'finalPrice'   => $products->sum('meta.price') ?: 0,
                'shipmentCost' => 0,
                'agentStatus'  => 'processless',
                'shipmentStatus' => 0,
                'completed' => 0,
                'agentNote'    => '',
                'status'       => 'pending',
            ]);
            $contentAttr = [
                'entity_type_id' => 33,
                'entity_status'  => 'pending',
                'creator_id'     => 1,
                'parent_id'      => 0,
                'meta'           => $request->all(),
            ];
            $content = Content::create($contentAttr);

            $response = [
                //"redirect"   => $request->get('success_url'),
                "reload"     => false,
                "message"    => "Sipariş başarılı, şimdi yönlendiriliyorsunuz.",
                "reset_form" => false,
                // "data"       => $contentAttr,
            ];
        } catch (\Throwable $th) {
            $response = [];
        }

        return response()->json($response);

    }
    public function addOrderTest(Request $request)
    {


        try {
            $products = $request->has('product_id') ? Content::where('entity_type_id', 4)
                ->where('content_id', $request->get('product_id'))
                ->get() : collect([]);
            $city = DB::table('zone')->where('name', $request->get('city'))->first();
            $town = DB::table('town')->where('zone_id', $city->zone_id)->where('name', $request->get('district'))->first();
            $request->merge([
                'fullname'     => $request->get('firstname') . ($request->has('lastname') ? ' ' . $request->get('lastname') : ''),
                'lastname'     => $request->get('lastname') ?: '',
                'phone_number' => $phoneNumber,
                'hasOldOrder'  => 0,
                'client_ip'    => $request->ip(),
                'browser'      => $request->header('User-Agent'),
                'city'         => $request->has('city') ? $city->zone_id : 0,
                'town'         => $request->has('district') ? $town->town_id : 0,
                'products'     => $products->toArray(),
                'firstPrice'   => $products->sum('meta.price') ?: 0,
                'finalPrice'   => $products->sum('meta.price') ?: 0,
                'shipmentCost' => 0,
                'agentStatus'  => 'processless',
                'shipmentStatus' => 0,
                'agentNote'    => '',
                'status'       => 'pending',
            ]);
            $contentAttr = [
                'entity_type_id' => 33,
                'entity_status'  => 'pending',
                'creator_id'     => 1,
                'parent_id'      => 0,
                'meta'           => $request->all(),
            ];
            $content = Content::create($contentAttr);


        } catch (\Throwable $th) {
            $response = [];
        }

        return response()->json([]);

    }


    public function uploadImage($file)
    {
        /*
        print_r($request->allFiles('image'));
        //$this->uploadImage($request->file('image'));

        foreach ($request->allFiles()['image'] as $value) {
        $this->uploadImage($value);
        }

         */
        $response = null;
        $user     = (object) ['image' => ""];
        if ($file) {
            $original_filename     = $file->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext              = end($original_filename_arr);
            $destination_path      = './upload/user/';
            $image                 = 'UA-' . time() . '.' . $file_ext;
            if ($file->move($destination_path, $original_filename)) {
                $user->image = '/upload/user/' . $image;
                // return $this->responseRequestSuccess($user);
            } else {
                //  return $this->responseRequestError('Cannot upload file');
            }
        } else {
            //return $this->responseRequestError('File not found');
        }
    }

    public function uploadImage2(Request $request)
    {
        $response = null;
        $user     = (object) ['image' => ""];
        if ($request->hasFile('image')) {
            $original_filename     = $request->file('image')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext              = end($original_filename_arr);
            $destination_path      = './upload/user/';
            $image                 = 'U-' . time() . '.' . $file_ext;
            if ($request->file('image')->move($destination_path, $image)) {
                $user->image = '/upload/user/' . $image;
                return $this->responseRequestSuccess($user);
            } else {
                return $this->responseRequestError('Cannot upload file');
            }
        } else {
            return $this->responseRequestError('File not found');
        }
    }
    protected function responseRequestSuccess($ret)
    {
        return response()->json(['status' => 'success', 'data' => $ret], 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
    protected function responseRequestError($message = 'Bad request', $statusCode = 200)
    {
        return response()->json(['status' => 'error', 'error' => $message], $statusCode)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
