<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price',
        'image',
        'description',
        'cat_id'
    ];

    protected $guarded = [

    ];

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

}
