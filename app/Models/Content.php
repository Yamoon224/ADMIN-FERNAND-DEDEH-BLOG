<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Content
 * 
 * @property int $id
 * @property string|null $body
 * @property string $path_image
 * @property int $hashtag_id
 * @property int $daily_id
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * 
 * @property Daily $daily
 * @property Hashtag $hashtag
 * @property User $user
 *
 * @package App\Models
 */
class Content extends Model
{
	use SoftDeletes;

	protected $casts = [
		'hashtag_id' => 'int',
		'daily_id' => 'int',
		'created_by' => 'int'
	];

	protected $guarded = [];

	public function daily()
	{
		return $this->belongsTo(Daily::class);
	}

	public function hashtag()
	{
		return $this->belongsTo(Hashtag::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
