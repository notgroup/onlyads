<?php

namespace App\Http\Controllers;

use App\Models\EavAttribute;
use App\Models\EavGroup;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{

    public function getSearch(Request $request)
    {
        //http://wikiproduct.test/getSearch?ekran_sekli=Daire&servis_ve_uygulamalar=Gelen%20SMS%20Bildirimi,Gelen%20Arama%20Bildirim
//$testQuery = collect($request->query());
    $jsonTest = DB::connection('maridbtest')->table('json_test');

foreach ($request->all() as $key => $value) {
    if (count(explode(',', $value)) > 1) {
        # code...
   $jsonTest->whereJsonContains("attr->" . $key, explode(',', $value));
    } else {
   $jsonTest->where("attr->" . $key, $value);

    }
}

    //->where('attr->govde_malzemesi', 'Alüminyum')
    //->whereJsonContains('attr->kordon_malzemesi', ['Naylon','Örgü'])
    //->selectRaw("JSON_EXTRACT(attr, '$.marka') as marka, count(JSON_EXTRACT(attr, '$.marka')) count")
    //->select('attr->marka as marka', DB::raw('count(id) count'))
    //->whereJsonContains('attr->ekran_teknolojisi', ['AMOLED'])
    //->whereJsonContains('attr->servis_ve_uygulamalar', ['Gelen SMS Bildirimi'])
    //->orWhereJsonContains('attr->desteklenen_aktiviteler', ['Golf'])
    //->where('attr->marka', $request->input('marka'))
    //->where('attr->ekran_teknolojisi', 'AMOLED')
    //->where('attr->govde_malzemesi', 'Alüminyum')
    //->where('attr->marka', 'Acer')
    //->where('attr->yil', 2015)
    //->where('attr->kod', '(UM.PX1EE.005)')
    //->groupBy('marka')
    $jsonTest = $jsonTest->limit('10')->get()->toArray();
    return response()->json($jsonTest);

        //return response()->json($request->query());
    }
    public function getSearchGroupJson($request)
    {
       /* SELECT DISTINCT eav_attribute_group.*
        FROM eav_attribute_group, json_each(eav_attribute_group.places, '$.terms')
       WHERE json_each.value = '914';*/
       $jsonTest = DB::table(DB::raw("eav_attribute_group, json_each(eav_attribute_group.places, '$.terms')"))
       ->select(DB::raw('eav_attribute_group.*'))
       ->where([['entity_type_id', '=', $request['entity']], ['is_primary', '=', 0]]);
        if ($request['terms']) {
            $terms = $request['terms'];
           // $jsonTest->whereRaw("json_each.value = '$terms'");
           // $arr = array_map("strval",[1,2,3,4]);
            $jsonTest->whereIn("json_each.value", array_map('intval',explode(',', $terms)));
        }
   // print_r([explode(',', $terms),$jsonTest->get()->pluck('attribute_group_id')]);
    //die();

      return $jsonTest->get()->pluck('attribute_group_id');
        //$attributes = EavAttribute::whereIn('attribute_id', $jsonTest->selected_attributes)->get();
       // return response()->json($jsonTest);
        //return response()->json([$request->entity, $request->terms]);
    }

    public function getSearchGroup(Request $request)
    {
/*print_r($this->getSearchGroupJson($request->all()));
die();*/
        $jsonTest = EavGroup::select('*')->where('entity_type_id', $request->entity);
        if ($request->terms) {
            $jsonTest->whereIn("attribute_group_id", $this->getSearchGroupJson($request->all()));
            $jsonTest->orWhere([['entity_type_id', '=', $request->entity], ['is_primary', '=', 1]]);
        } else {
            $jsonTest->where([['entity_type_id', '=', $request->entity], ['is_primary', '=', 1]]);
        }

        $jsonTest = $jsonTest->get();
        //$attributes = EavAttribute::whereIn('attribute_id', $jsonTest->selected_attributes)->get();
        return response()->json($jsonTest);
        //return response()->json([$request->entity, $request->terms]);
    }
    public function getFilterableFields(Request $request)
    {

        $jsonTest = EavGroup::select('*')->where('entity_type_id', $request->entity);
        if ($request->terms) {
            $jsonTest->whereRaw("JSON_CONTAINS(places, '[\"$request->terms\"]', 'terms')");
            $jsonTest->orWhere([['entity_type_id', '=', $request->entity], ['is_primary', '=', 1]]);
        } else {
            $jsonTest->where([['entity_type_id', '=', $request->entity], ['is_primary', '=', 1]]);
        }

        $selectedAttributes = $jsonTest->get()->pluck('selected_attributes')->flatten();

        $jsonTest = EavAttribute::where('is_filterable', '1')->where('entity_type_id', $request->entity)->get();
        $jsonTest =    $jsonTest->map(function ($item, $key){
            if ($item->frontend_input == 'term_select' && isset($item->data['taxonomy']) && $item->data['taxonomy'] == 'product') {
            $termTaxonomyIds = DB::table('term_variant')
            ->where('term_type_id', 23)
            ->leftJoin('terms', 'term_variant.term_id', '=', 'terms.term_id')
            ->get();
            $item->values = $termTaxonomyIds;
        }
        return $item;

    });
/*
$methods = get_class_methods($jsonTest);
print_r($methods);
die();*/
return response()->json($jsonTest);
}
public function getCrudForm(Request $request)
{
    $eavGroups = EavGroup::select('*')
    ->whereRaw("JSON_CONTAINS(places, '[\"$request->entity\"]', 'entities')")
    ->get();
    return response()->json($eavGroups);
}

}
