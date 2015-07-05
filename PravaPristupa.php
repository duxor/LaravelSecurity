<?php
/**
 * Created by PhpStorm.
 * User: Dušan
 * Date: 2/10/2015
 * Time: 5:04 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class PravaPristupa extends Model {
    protected $table = 'pravapristupa';
    protected $fillable = ['id','naziv','created_at','updated_at'];
}