<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;
    protected $table = 'form_data';
    protected $fillable = [
        'profile_image', 'name', 'phone', 'email', 'street_address', 'city', 'state', 'country'
    ];
}

