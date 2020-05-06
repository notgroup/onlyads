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

        $cities = DB::table('zone')->get()->keyBy('zone_id');
        /*print_r($cities);
        die();*/
        $towns          = DB::table('town')->get()->keyBy('town_id');
        $paymentMethods = Content::where('entity_type_id', 35)->get()->keyBy('content_id');

        $newData     = [];
        $defaultKeys = ["mok", "urun", "ad", "adres", "ilce", "sehir", "tel", "irsaliyeno", "ilkodu", "ilcekodu", "varis", "serino", "desi", "tahsilat_tutari", "odeme_tipi"];
        $exampleItem = array_fill_keys(array_values($defaultKeys), null);
        foreach ($data as $key => $preItem) {
            $preItem                      = collect($preItem);
            $emptyItem                    = $exampleItem;
            $emptyItem["mok"]             = $preItem['content_id'];
            $emptyItem["urun"]            = array_values($preItem['meta']['products'])[0]['meta']['title'];
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
        if ($request->has('selecteds')) {
            $items     = Content::where('entity_type_id', $entity_type_id)->whereIn('content_id', $request->get('selecteds'));
            if (strpos($request->get('status'), ':')) {
                $status = explode(':', $request->get('status'));
                $updateArr = ['meta->shipment_type' => $status[1], 'entity_status' => $status[0], 'meta->update_' . $status[0] => date('d/m/Y H:i')];
            } else {
                $updateArr = ['entity_status' => $request->get('status'), 'meta->update_' . $request->get('status') => date('d/m/Y H:i')];
            }
            $items->update($updateArr);
        }


        return response()->json([]);
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
        $request->merge(['meta' => array_merge($request->meta, ['ip' => $request->ip()])]);
        if ($request->has('content_id')) {
            $request->merge(['creator_id' => $request->user()->id]);
            Content::where(['content_id' => $request->input('content_id')])->update($request->all());
            //ContentMeta::where(['content_id' => $request->input('content_id')])->update(['content_id' => $request->input('content_id'), 'attributes' => $request->input('meta')]);
            $content = Content::find($request->input('content_id'));
        } else {
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
        $products = $request->has('product_id') ? Content::where('entity_type_id', 4)
            ->whereIn('content_id', $request->get('product_id'))
            ->get() : collect([]);
        $request->merge([
            'title'        => $request->get('firstname') . '/' . date('Y_m_d_H_i'),
            'fullname'     => $request->get('firstname') . ($request->has('lastname') ? ' ' . $request->get('lastname') : ''),
            'lastname'     => $request->get('lastname') ?: '',
            'phone_number'     => $request->has('phone_number') ? substr($request->get('phone_number'), -10) : '',
            'redirect'     => $request->get('success_url'),
            'client_ip'    => $request->ip(),
            'browser'      => $request->header('User-Agent'),
            'town'         => $request->has('district') ? $request->get('district') : $request->get('town'),
            'products'     => $products->keyBy('content_id'),
            'firstPrice'   => $products->sum('meta.price') ?: 0,
            'finalPrice'   => $products->sum('meta.price') ?: 0,
            'shipmentCost' => 0,
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
            "data"       => $contentAttr,
        ];
        return response()->json($response);

    }

    public function addContent2(Request $request, $type_id)
    {

        /*
        Bu bölümde media dosyaları gelebilir upload için metod yazılmalı.
        Bu bölümde taxonomy/term tanımlamaları yapılabilir, metod yazılmalı.

         */

        $attributes = $request->input('attributes');
        /*
        //$formDetails = $this->getCrudForm($type_code);

        $entity = DB::table('entities')->where('entity_code', 'content')->where('id', $type_id)->first();

        $entityContentId = DB::table('contents')->insertGetId(['entity_type_id' => $entity->id]);
        $entityContent = DB::table('content_meta')->insert(['content_id' => $entityContentId,'attributes' => json_encode($attributes)]);
         */
        $eavAttrs    = EavAttribute::where('entity_type_id', $type_id)->whereIn('attribute_code', array_keys($attributes))->get()->toArray();
        $response    = [];
        $insertTerms = [];
        foreach ($eavAttrs as $key => $value) {
            $formValue = $attributes[$value['attribute_code']];

            switch ($value['field_type']) {
                case 'tags_insert':
                    $response[$value['attribute_code']] = $this->setTags($formValue);
                    break;
                case 'term_select':
                    $insertTerms                        = $this->setTerms($formValue);
                    $response[$value['attribute_code']] = (int) $formValue;
                    break;
                case 'single_image_upload':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'single_file_upload':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'multiple_image_upload':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'checkbox':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'multiselect':
                    $response[$value['attribute_code']] = $this->setMultiSelect($formValue);
                    break;
                case 'select':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'entity_status':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'text':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'editor':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'media_gallery':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'single_map_select':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'oembed':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'radio':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'price':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'date':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'rating':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'color':
                    $response[$value['attribute_code']] = $formValue;
                    break;
                case 'range':
                    $response[$value['attribute_code']] = $formValue;
                    break;

                default:
                    $response[$value['attribute_code']] = $formValue;
                    break;
            }
        }

        $entity      = Entities::where('entity_code', 'content')->where('id', $type_id)->first();
        $contentAttr = collect($attributes)->only(['content_id', 'entity_status', 'entity_type_id', 'parent_id', 'created_at', 'updated_at', 'creator_id']);
        $contentAttr->merge($response);
        $contentAttr                   = $contentAttr->toArray();
        $contentAttr['entity_type_id'] = $type_id;
        if ($request->has('api_token')) {
            $contentAttr['creator_id'] = $request->user()->id;
        }

        $entityContentId = Content::insertGetId($contentAttr);
        $entityContent   = ContentMeta::create(['content_id' => $entityContentId, 'attributes' => $response]);
        $content         = Content::find($entityContentId);
        if ($insertTerms) {
            $content->terms()->sync((array) $insertTerms, true);
        }
        //print_r($content);

        return response()->json($content);
    }

    public function setTags($formValue)
    {
        return is_array($formValue) ? $formValue : explode(',', $formValue);
    }
    public function setTerms($formValue)
    {
        $term = TermVariant::find($formValue);
        //$content->terms()->sync((array) $term->getPathText(), true);
        //print_r($term->toArray());
        //$content->terms()->sync((array) $response['taxonomy_category'], true);
        //$content->terms()->attach($response['taxonomy_category']);
        //print_r($content->termList()->get()->toArray());
        return (array) $term->getPathText();
    }
    public function setMultiSelect(array $formValue)
    {
        return $formValue;
    }

    public function getCrudForm($entity)
    {
        $eavGroups = EavGroup::select('*')
            ->whereRaw("JSON_CONTAINS(places, '[\"$entity\"]', 'entities')")
            ->first();
        return $eavGroups;
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
