<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'name'=>'N/A',
        ]);
    }

}
