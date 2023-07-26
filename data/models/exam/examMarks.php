<?php 
//Visit "codeastro.com" for more projects!
use \Illuminate\Database\Eloquent\Model as Eloquent;

class ExamMarks extends Eloquent 
{
	protected $primaryKey = 'id';
	protected $table = 'sms_exam_marks';
	protected $guarded =['created_at', 'updated_at'];
	public $timestamps = false;
	


protected $hidden = [
        'created_at', 'updated_at',
    ];

}
