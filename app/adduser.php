<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adduser extends Model
{
    protected $table = "adduser";
    protected $fillable = ['name','number','gender','address','state','city','filename'];

}
