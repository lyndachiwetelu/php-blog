<?php declare(strict_types=1);


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'posts';
	protected $fillable = ['title', 'content'];


	public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}
}