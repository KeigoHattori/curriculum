<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['item_name', 'price', 'item_description', 'item_image', 'item_status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // モデルが作成される前に実行する処理
        });

        static::created(function ($model) {
            // モデルが作成された後に実行する処理
        });
    }

}
