<?php declare(strict_types=1);


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'users';
	protected $fillable = ['name', 'email'];

	public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}
}