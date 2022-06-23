<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'content',
        'image',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descendants() {
        return $this->hasMany(Category::class, 'parent_id')->with('descendants');
    }


    public static function roots() {
        return self::where('parent_id', 0)->with('children')->get();
    }


    public static function hierarchy() {
        return self::where('parent_id', 0)->with('descendants')->get();
    }


    public function validParent($id) {
        $id = (integer)$id;
        // получаем идентификаторы всех потомков текущей категории
        $ids = $this->getAllChildren($this->id);
        $ids[] = $this->id;
        return ! in_array($id, $ids);
    }


    public static function getAllChildren($id) {

        $children = self::where('parent_id', $id)->with('children')->get();
        $ids = [];
        foreach ($children as $child) {
            $ids[] = $child->id;

            if ($child->children->count()) {
                $ids = array_merge($ids, self::getAllChildren($child->id));
            }
        }
        return $ids;
    }
}
