<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVisitor extends Model
{
    protected $fillable = ['ip_address', 'user_agent', 'content'];

}
