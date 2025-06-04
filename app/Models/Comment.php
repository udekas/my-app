<?php

namespace App\Models;

use App\Observers\CommentObServer;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(CommentObServer::class)]

class comment extends Model
{
    
   protected $guarded = [];

   protected $appends = ['created_at_for_humans'];

   public function user()
   {
       return $this->belongsTo(User::class);
   }

       public function createdAtForHumans(): Attribute
       {
         return Attribute::make(
         get: fn () => $this->created_at->diffForHumans(),
      );
   }
}
