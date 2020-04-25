<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EavAttribute extends Model
{
    protected $fillable = [
        'attribute_code',
        'attribute_group_id',
        'frontend_label',
        'backend_type',
        'frontend_input',
        'backend_type',
        'is_required',
        'is_user_defined',
        'is_unique',
        'data',
        'entity_type_id',
        'help_description',
        'default_value',
        'field_type'
    ];
    protected $casts = [
        'data' => 'array',
        'attribute_group_id' => 'int',
        'entity_type_id' => 'int',
        'is_user_defined' => 'int',
        'is_required' => 'int',
        'is_unique' => 'int',
    ];
    protected $table = 'eav_attribute';
    protected $primaryKey = 'attribute_id';
    protected $appends = [];
    public $timestamps = false;
    protected $hidden = [];

    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute', 'attribute_group', 'group_id', 'attribute_id');

    }
}

/*
https://github.com/lazychaser/laravel-nestedset
http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/
public function childrenRecursive()
{
return $this->children()->with('childrenRecursive');
}

// recursive, loads all descendants
public function childrenRecursive()
{
return $this->children()->with('childrenRecursive');
}
and to get parents with all their children:

$categories = Category::with('childrenRecursive')->whereNull('parent')->get();

function getDepth($category, $level = 0) {
if ($category->parent_id>0) {
if ($category->parent) {
$level++;
return $this->getDepth($category->parent, $level);
}
}
return $level;
}

$category = Category::find(1);
$category_ids = $category->getDescendants($category);
It will result ids in array all descendants of your category where id=1. then :

$products = Product::whereIn('category_id',$category_ids)->get();

// app/Category.php

public function children(): HasMany
{
return $this->hasMany(static::class, 'cat_parent_id', 'id');
}
Then to obtain all children of the main category:

use App\Category;

$children = Category::where('name','Child-1- P - 2')->first()->children;
And here is a supporting test with a factory:

// database/factories/CategoryFactory.php

use App\Category;

$factory->define(Category::class, function (Faker $faker) {
static $id = 1;
return [
'name' => 'Category '.$id++,
'cat_parent_id' => null,
];
});

// tests/Unit/Models/CategoryTest.php

use App\Category;

public function returns_associated_child_records()
{
// create master records
factory(Category::class, 3)->create();

// get parent for the sub-categories
$parent = $master->first();

// create sub-categories
foreach(range(1, 4) as $id) {
factory(Category::class)->create([
'name' => 'Sub category '.$id,
'cat_parent_id' => $parent->id
]);
}

$this->assertEquals(
['Sub category 1', 'Sub category 2', 'Sub category 3', 'Sub category 4'],
Category::where('name', $parent->name)->first()->children->pluck('name')->toArray()
);
}

$products = Category::getAllProducts($categoryId);

public static function getAllProducts($categoryId, $products = null)
{
if ($products === null) {
$products = collect();
}
$category = Category::find($categoryId);
$products = $products->merge($category->product);
$category->children->each(function($child) {
$products = self::getAllProducts($child->id, $products);
});

return $products;
}
 */
