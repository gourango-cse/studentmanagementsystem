<?php 
 //Visit "codeastro.com" for more projects!
use \Illuminate\Database\Eloquent\Model as Eloquent;
 
class Library extends Eloquent {
 
   protected $primaryKey = 'id';
	protected $table = 'sms_library';
	protected $fillable =['name','publication','author','class_id','subject_id'];
	public $timestamps = FALSE;
	


protected $hidden = [
        'created_at', 'updated_at',
    ];

//Visit "codeastro.com" for more projects!
}