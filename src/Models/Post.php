<?php declare(strict_types=1);


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;
	
	protected $primaryKey = 'id';
	protected $table = 'posts';
	protected $fillable = ['title', 'content'];


	public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}
}