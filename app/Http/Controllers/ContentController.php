<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentMeta;
use App\Models\EavAttribute;
use App\Models\EavGroup;
use App\Models\Entities;
use App\Models\TermVariant;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function getContents(Request $request, $entity_type_id)
    {
        $contents = Content::where('entity_type_id', $entity_type_id)
        //->where('entity_status', 'draft')
        // ->latest()
            ->orderBy('content_id', 'desc')
            ->limit(10)->get()->toArray();
        return response()->json($contents);
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
            $request->merge(['creator_id' => $request->user()->id]);
            Content::where(['content_id' => $request->input('content_id')])->update($request->all());
            //ContentMeta::where(['content_id' => $request->input('content_id')])->update(['content_id' => $request->input('content_id'), 'attributes' => $request->input('meta')]);
            $content = Content::find($request->input('content_id'));
        } else {
            $contentAttr = [
                'entity_type_id' => $type_id,
                'entity_status'  => 1,
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
