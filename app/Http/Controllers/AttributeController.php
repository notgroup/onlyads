<?php

namespace App\Http\Controllers;

use App\Models\EavAttribute;
use App\Models\EavGroup;
use App\Models\Entity;
use App\Models\Term;
use App\Models\TermEntity;
use App\Models\TermVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{

    public function addGroup(Request $request)
    {
        $data = ["location_obj" => $request->input('location_obj')];

        // attribute listesini ekle
        $attributes = $request->input('attributes');
        /* foreach ($attributes as $attr_key => $attr_value) {
        EavAttribute::create($attr_value);
        }*/

        $item = EavGroup::create([
            'attribute_group_name' => "",
            'attribute_group_code' => "",
            'tab_group_code' => "",
            'description' => "",
            'rules' => "",
            'taxonomy' => "",
            'term_taxonomy_ids' => "",
            'sort_order' => "",
            'status' => "",
            'is_primary' => "",
            'data' => json_encode($data),
        ]);
        return response()->json($item);
    }
    public function addAttribute(Request $request, $entityId)
    {
        $request->merge(['entity_type_id' => $entityId]);
        $item = EavAttribute::create($request->all());
        return response()->json($item);
    }
    public function updateAttribute(Request $request)
    {
        //$request->merge(['backend_type' => 'static']);
        $item = EavAttribute::where('attribute_id', $request->attribute_id)->update($request->all());
        return response()->json(['error' => $item ? false : true, 'message' => $item ? 'success' : 'error']);
    }
    public function attachAttrToGroup(Request $request)
    {
        $item = 0;
        //$request->merge(['backend_type' => 'static']);
        foreach ($request->attrs as $attrId => $groupId) {
         $item = EavAttribute::where('attribute_id', $attrId)->update(['attribute_group_id' => $groupId]);
        }
        return response()->json(['error' => $item ? false : true, 'message' => $item ? 'success' : 'error']);
    }

    public function getEntityCollection(Request $request)
    {
        $tableItems = Entity::limit(10)->get()->toArray();
        return response()->json($tableItems);
    }



    public function demoAction()
    {
        $entity = Entity::find(10);

        $response = [];
        $response['entity'] = $entity;
        return response()->json($response);
    }
}
