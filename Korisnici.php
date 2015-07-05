<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Korisnici extends Model {

	protected $table = 'korisnici';

    protected $fillable = ['id', 'pravapristupa_id', 'username', 'password', 'token', 'online', 'aktivan', 'create_at', 'update_at'];

}
