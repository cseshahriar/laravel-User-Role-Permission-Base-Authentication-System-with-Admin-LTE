<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];  

    // child category
    // categories table id, category_parent table id
    // primary table, primary_table_id, foreing_table, foreign_table_id
    public function childrens() {
        return $this->belongsToMany(Category::class, 'category_parent','parent_id','category_id');
    }

    // parent caterory
    public function parents() { 
    	// primary table, foreign_table, foreign_table_id, primary_table_id  
        return $this->belongsToMany(Category::class, 'category_parent', 'category_id', 'parent_id');  
    } 

}
