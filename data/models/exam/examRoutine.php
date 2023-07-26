<?php 
//Visit "codeastro.com" for more projects!
use \Illuminate\Database\Eloquent\Model as Eloquent;

class ExamRoutine extends Eloquent 
{
	protected $primaryKey = 'id';
	protected $table = 'sms_exam_routine';
	protected $guarded =['created_at', 'updated_at','id'];
	public $timestamps = false;
	


protected $hidden = [
        'created_at', 'updated_at',
    ];

}
