<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['message'];

    public function user(){
       return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value){
        $createdAt = Carbon::parse($value);
        return $createdAt->format('F d, Y g:i a');
    }
}
