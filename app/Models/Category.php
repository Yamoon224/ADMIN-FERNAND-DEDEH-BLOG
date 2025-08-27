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
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|Article[] $articles
 *
 * @package App\Models
 */
class Category extends Model
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

	public function articles()
	{
		return $this->hasMany(Article::class);
	}
}
