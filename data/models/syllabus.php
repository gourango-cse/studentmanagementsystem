<?php 
 //Visit "codeastro.com" for more projects!
use \Illuminate\Database\Eloquent\Model as Eloquent;
 
class Syllabus extends Eloquent {
 
   protected $primaryKey = 'id';
	protected $table = 'sms_syllabus';
	protected $fillable =['name','class_id','subject_id','file','count'];
	public $timestamps = FALSE;
	


protected $hidden = [
        'created_at', 'updated_at',
    ];


}