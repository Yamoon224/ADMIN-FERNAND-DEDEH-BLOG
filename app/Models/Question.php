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
 * Class Question
 * 
 * @property int $id
 * @property string|null $title
 * @property string $body
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|Comment[] $comments
 *
 * @package App\Models
 */
class Question extends Model
{
	use SoftDeletes;

	protected $casts = [
		'created_by' => 'int'
	];

	protected $guarded = [];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function comments()
	{
		return $this->hasMany(Comment::class, 'question_id');
	}
}
