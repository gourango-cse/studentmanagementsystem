<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class NoticeModel extends Eloquent 
{
	protected $primaryKey = 'id';
	protected $table = 'sms_notice';
	protected $fillable =['title','body'];
	public $timestamps = false;
	


protected $hidden = [
        'created_at', 'updated_at',
    ];
//Visit "codeastro.com" for more projects!
}