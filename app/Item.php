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

    public function isSold()
    {
        return $this->purchases()->exists();
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'item_id', 'user_id');
    }

    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
