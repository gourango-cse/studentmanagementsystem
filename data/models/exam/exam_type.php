<?php 
//Visit "codeastro.com" for more projects!
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Exam_type extends Eloquent 
{
	protected $primaryKey = 'id';
	protected $table = 'sms_exam_type';
	protected $fillable =['name'];
	public $timestamps = false;
	


protected $hidden = [
        'created_at', 'updated_at',
    ];

}