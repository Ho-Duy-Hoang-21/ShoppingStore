<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable =
        [
            'id',
            'name',
            'image',
            'id_user',
            'price',
            'id_category',
            'id_brand',
            'status',
            'sale',
            'company',
            'detail'
        ];

    protected $casts = [
        'image' => 'array', // tự decode JSON khi lấy ra
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
