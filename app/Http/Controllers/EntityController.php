<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Entities;
use App\Models\Entity;
use App\Models\Term;
use App\Models\TermEntity;
use App\Models\TermVariant;
use App\Models\EavGroup;
use App\Models\EavAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EntityController extends Controller
{

    public function getEntities(Request $request)
    {

        $entities = Entities::get()->toArray();

       return response()->json($entities);
    }

    public function getLastEntity(Request $request)
    {

        $entities = Entity::limit(20)
        //->where('type_id', $type_id)
//->where('entity_type_id', 4)
       ->get()->toArray();

    return response()->json($entities);
    }

}
