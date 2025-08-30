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
 * Class Hashtag
 * 
 * @property int $id
 * @property string $hashtag
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|Content[] $contents
 *
 * @package App\Models
 */
class Hashtag extends Model
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

	public function contents()
	{
		return $this->hasMany(Content::class);
	}
}
