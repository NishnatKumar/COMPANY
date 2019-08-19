<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
   protected $table="document_requests";

   public $fillable=['id', 'months', 'userID', ];
}
