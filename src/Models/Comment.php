<?php declare(strict_types=1);


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'comments';
	protected $fillable = ['user_id', 'post_id', 'content'];

	public function post()
	{
		return $this->belongsTo('App\Models\Post');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

}