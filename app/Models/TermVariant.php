<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TermVariant extends Model
{
    protected $guarded = ['variant_id'];
    protected $fillable = ['type_id', 'term_id', 'term_type_id', 'level', 'parent_id'];
    protected $casts = ['attributes' => 'array','term_id' => 'integer','term_type_id', 'integer'];
    protected $table = 'term_variant';
    protected $primaryKey = 'variant_id';
    protected $appends = [
        'bread_crumb'
    ];
    public $timestamps = false;
    protected $hidden = [];

    public function scopeSetJoinTerm($query)
    {
        return $query->leftJoin('terms', 'term_variant.term_id', '=', 'terms.term_id');
    }

    public function scopeSetJoinTermEntity($query)
    {
        return $query->leftJoin('term_content', 'term_variant.variant_id', '=', 'term_content.variant_id');
    }
    public function scopeSetJoinEntity($query)
    {
        return $query->leftJoin('entity', 'term_content.content_id', '=', 'entity.content_id');
    }
    public function scopeSetJoinContent($query)
    {
        return $query->leftJoin('contents', 'term_content.content_id', '=', 'contents.content_id');
    }
    public function scopeSetJoinTermType($query)
    {
        return $query->leftJoin('entities', 'term_variant.term_type_id', '=', 'entities.id');
    }

    public function term()
    {
        return $this->hasOne('App\Models\Term', 'term_id', 'term_id');
    }

    public function termEntity()
    {
        return $this->belongsToMany('App\Models\Entity', 'term_content', 'variant_id', 'content_id');
    }
    public function termContent()
    {
        return $this->belongsToMany('App\Models\Content', 'term_content', 'variant_id', 'content_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\TermVariant', 'parent_id')->with(['term']);
    }

    public function children()
    {
        return $this->hasMany('App\Models\TermVariant', 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function getPathText()
    {
        $parentPath = array_merge([$this->variant_id], $this->getParentIds());

        $parentPath = array_reverse($parentPath);
        return $parentPath;
    }

    public function getParentIds()
    {
        $parentPath = [];
        $termTax = $this;

        while ($termTax->parent) {
            $parentPath[] = $termTax->parent->variant_id;
            $termTax = $termTax->parent ?? 0;
        }
        //$parentPath = array_reverse($parentPath);
        return $parentPath;
    }

    public function getSearchGroupJson()
    {
        $termTax = $this;
       /* SELECT DISTINCT eav_attribute_group.*
        FROM eav_attribute_group, json_each(eav_attribute_group.places, '$.terms')
       WHERE json_each.value = '914';*/
       $jsonTest = DB::table(DB::raw("eav_attribute_group, json_each(eav_attribute_group.places, '$.terms')"))
       ->select(DB::raw('eav_attribute_group.attribute_group_id'))
       ->where([['entity_type_id', '=', 30], ['is_primary', '=', 0]]);

            $terms = [$termTax->variant_id];
           // $jsonTest->whereRaw("json_each.value = '$terms'");
           // $arr = array_map("strval",[1,2,3,4]);
            $jsonTest->whereIn("json_each.value", array_map('intval',$terms));

   // print_r([explode(',', $terms),$jsonTest->get()->pluck('attribute_group_id')]);
    //die();

      return $jsonTest->get()->pluck('attribute_group_id');
        //$attributes = EavAttribute::whereIn('attribute_id', $jsonTest->selected_attributes)->get();
       // return response()->json($jsonTest);
        //return response()->json([$request->entity, $request->terms]);
    }
    public function getParentItems()
    {
        $termTax = $this;
        $parentPath = $termTax->path ? explode('/', $termTax->path) : [$termTax->variant_id];

        //$parentPath = array_reverse($parentPath);
        return self::whereIn('variant_id', $parentPath)->with(['term'])->get();
    }
    public function getBreadCrumb()
    {
        $termTax = $this;
        $parentPath = $termTax->path ? explode('/', $termTax->path) : [$termTax->variant_id];

        $terms = self::whereIn('term_variant.variant_id', $parentPath)->with(['term'])->get()->pluck('term')->pluck('name','slug')->toArray();
        return $terms;
    }

    public function getBreadCrumbAttribute()
    {
        return $this->getBreadCrumb();
    }
    public function getPathText2($termTax)
    {
        $parentPath = [$termTax->variant_id];

        while ($termTax->parent) {
            $parentPath[] = $termTax->parent->variant_id;
            $termTax = $termTax->parent ?? 0;
        }
        $parentPath = array_reverse($parentPath);
        return $parentPath;
    }

    public function hasChildren()
    {
        if ($this->children->count()) {
            return true;
        }

        return false;
    }

    public function hasParent()
    {
        if ($this->parent) {
            return true;
        }

        return false;
    }

    public function findDescendants()
    {
        $this->descendants[] = $category->id;

        if ($category->hasChildren()) {
            foreach ($category->children as $child) {
                $this->findDescendants($child);
            }
        }
    }

}
