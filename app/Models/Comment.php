<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * 
 * @property int $id
 * @property string|null $comments
 * @property int $daily_question_id
 * @property Carbon $created_at
 * @property int|null $created_by
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * 
 * @property Question $question
 *
 * @package App\Models
 */
class Comment extends Model
{
	use SoftDeletes;

	protected $casts = [
		'daily_question_id' => 'int',
		'created_by' => 'int'
	];

	protected $guarded = [];

	public function question()
	{
		return $this->belongsTo(Question::class, 'question_id');
	}
}
