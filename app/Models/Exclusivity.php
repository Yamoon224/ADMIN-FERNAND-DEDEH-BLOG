<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Exclusivity
 * 
 * @property int $id
 * @property string $title
 * @property string $body
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Exclusivity extends Model
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
}
