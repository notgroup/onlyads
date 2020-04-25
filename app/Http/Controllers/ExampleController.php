<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Term;
use App\Models\TermEntity;
use App\Models\TermVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExampleController extends Controller
{

    public function getEntity(Request $request, $post_id)
    {
        $item = Entity::find($post_id)->toArray();
        return response()->json($item);
    }

    public function getEntityCollection(Request $request)
    {
        $tableItems = Entity::limit(10)->get()->toArray();
        return response()->json($tableItems);
    }

    public function getEntityAsTerm(Request $request, $type_id, $term_id, $entry_type_id)
    {
        $termVariant = TermVariant::where('entity_type_id', $type_id)
            ->where('variant_id', $term_id)
            ->first()
            ->termEntity()
            ->where('entity_type_id', $entry_type_id)
            ->setJoinEntity()
            ->get();

        return response()->json($termVariant);
    }

    public function insertTerm(Request $request, $type_id, $term_name)
    {
        $parent_id = 0;
        $level = 0;
        $count = 0;
        $term = Term::firstOrNew(['name' => $term_name, 'slug' => url_baslik_yarat($term_name)]);
        $term->save();

        $termId = $term->term_id;

        $termTax = $term->termVariant()->firstOrNew(['term_type_id' => $type_id, 'term_id' => $termId]);
        $termTax->save();
        return $termTax;
    }

    public function insertTermTest(Request $request)
    {
        $this->insertBulkTerms();
        return 0;
    }


    public function insertBulkTerms($termTypeId=23, $termList = '', $parent_id = 0)
    {
        $termList = explode("\n", '
        Elektronik
        Tasit/Motosiklet
        Elektronik/Bilgisayar, Donanım
        ');
       $termList = array_filter($termList);

       foreach ($termList as $key => $termsOfLine) {
           $termsOfLine = explode('/', $termsOfLine);
           $parent_id = 0;
           $level = [$parent_id];
           foreach ($termsOfLine as $key => $termName) {
               $termName = trim($termName);
               if(!$termName) continue;
            $level[] = $key;
              $parent_id = $this->insertTermVariant($termTypeId, $termName, $parent_id, count(array_filter($level)), '');
           }
       }



        return 0;
    }

    public function insertTermVariant($term_type_id, $term_name, $parent_id = 0, $level = 0, $path = '')
    {
        //$parent_id = 0;
        //$level = 0;
        //$count = 0;
        $term = $this->insertTermValue($term_name);
        $termId = $term->term_id;

        $termTax = TermVariant::where('term_id', $termId)->where('term_type_id', $term_type_id)->first();
        if (!$termTax) {
            $termTax = TermVariant::create(['term_type_id' => $term_type_id, 'term_id' => $termId, 'parent_id' => $parent_id, 'level' => $level, 'path' => '']);
            //$termTax->save();
        } else {
            $termTax->path = implode('/', $termTax->getPathText());
            $termTax->save();
        }
        return $termTax->variant_id;
    }

    public function insertTermValue($term_name)
    {
        $term = Term::firstOrNew(['name' => $term_name, 'slug' => Str::slug($term_name)]);
        if (!$term->term_id) {
            $term->save();
        }
        return $term;
    }

    public function termEntityTest()
    {
        $term = TermVariant::with(['term','parent'])->find(760);

        $response = ['term' => $term];
        $response['entities'] = $term->termEntity()->limit(1)->get();
        $response['parent'] = $term->getParentIds();
        return $response;
    }
    public function entityTermsTest()
    {
        $entity = Entity::find(10);

        $response = [];
        $response['entity'] = $entity;
        $response['terms'] = $entity->termList;
        return $response;
    }


    public function demoAction()
    {
        $entity = Entity::find(10);

        $response = [];
        $response['entity'] = $entity;
        return response()->json($response);
    }

}
