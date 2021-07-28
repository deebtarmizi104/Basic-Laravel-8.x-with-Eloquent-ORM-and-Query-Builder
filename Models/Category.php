<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'user_id',
      'category_name',
    ];

    // BELOW IS THE ELOQUENT ORM METHOD IN JOINING TABLES
    public function user(){
      return $this->hasOne(User::class, 'id', 'user_id');
      //JOIN TABLE: HAS ONE RELATIONSHIP WITH USER TABLE (id) AND CATEGORY TABLE (user_id)
    }


}
