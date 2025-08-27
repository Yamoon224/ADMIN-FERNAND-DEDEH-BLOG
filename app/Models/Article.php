<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 * 
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string|null $content
 * @property string $path_resource
 * @property int|null $category_id
 * @property string $status
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Category|null $category
 * @property Collection|Comment[] $comments
 *
 * @package App\Models
 */
class Article extends Model
{
	use SoftDeletes;

	protected $casts = [
		'category_id' => 'int',
		'created_by' => 'int'
	];

	protected $guarded = [];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}
