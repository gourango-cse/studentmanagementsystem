<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['calender/show/(:any)/(:any)']= 'calender/show/$1/$2';


$route['default_controller'] = "home";
$route['404_override'] = '';
$route['home'] = 'home';
$route['notice'] = "notice/view";


// library
$route['library'] = 'library/home';

// account session
$route['account/manage'] = 'account/account';
$route['account/fees'] = 'account/account/fees';
$route['account/operation/(:any)'] = 'account/account/operation/$1';
$route['account/list_student'] = 'account/account/list_student';
$route['account/get_status'] = 'account/account/get_status';

// add account type
$route['account/type/add'] = 'account/account/create_ac_type';
$route['account/type/update'] = 'account/account/update_ac_type';
$route['account/type/delete'] = 'account/account/delete_ac_type';
$route['account/list/type'] = 'account/account/list_type';

$route['account/create/fees'] = 'account/account/create_fees';
$route['account/update/fees'] = 'account/account/update_ac_fees';
$route['account/delete/fees'] = 'account/account/delete_ac_fees';
$route['account/list/fees'] = 'account/account/list_fees';

////////////////////////Session Login / Register - URL  ajax url /////////////
$route['session/msg_log'] = "session/msg_log"; // real notification 
$route['session/login'] = "session/login"; // user login  controler
$route['session/register'] = "session/register"; // user registrstion
$route['session/logout'] = "session/logout"; // logout purpose
$route['session/view'] = 'session/view_session'; // academic session

$route['session/count_mail'] = 'session/count_unread'; /// count unread message

//-------------------------Account verification----------------------//
$route['account/verification/:num/:any'] = 'session/verification';

////////////////////////////////////////////////////////////////////
$route['login'] = "login";
$route['debug'] = "debug";



$route['permission']='error/no_permission';
///////////////////////////////////////Student Module////////////////////////////



/* Add Student  */
$route['student/add']="student/student_add";
$route['student/list_section']="student/student_view/list_section";
$route['student/list_student']="student/student_view/list_student";

$route['student/add/post'] = "student/student_add/add";
$route['form'] = 'validate_ctr';

/* list Student */
$route['student/view'] = 'student/student_view';
$route['student/view/count'] = 'student/student_view/count';

/* view Student */

$route['student/edit/:any'] = 'student/student_profile/edit';
$route['student/:any'] = 'student/student_profile/view';


//////////////////////////////////Teacher MOdule/////////////////////////////////

/* Add Student  */
$route['teacher/add']="teacher/teacher_add";
$route['teacher/add/post'] = "teacher/teacher_add/add";


/* View Student */
$route['teacher/view'] = 'teacher/teacher_view';
$route['teacher/edit/:any'] = 'teacher/teacher_profile/edit';
$route['teacher/:any'] = 'teacher/teacher_profile/view/';

//////////////////////////////////Parent MOdule/////////////////////////////////

/* Add Parent  */
$route['parent/add']="parent/parent_add";
$route['parent/add/post'] = "parent/parent_add/add";


/* View parent */
$route['parent/view'] = 'parent/parent_view';

$route['parent/edit/:any'] = 'parent/parent_profile/edit';
$route['parent/:any'] = 'parent/parent_profile/view/';
///////////////////////////////Class MOdule/////////////////////////////////////

/* Add class  */
$route['class/manage']="class/manage_class";
$route['class/manage/add_class'] = "class/manage_class/add_class";
$route['class/manage/edit'] = "class/manage_class/edit_class";  //edit class
$route['class/manage/delete'] = "class/manage_class/delete_class";  //delete class
$route['class/manage/delete_section'] = "class/manage_class/delete_section";// delete section


$route['class/manage/update_section'] = "class/manage_class/update_section";  //update class
$route['class/manage/class_teacher']="class/manage_class/assign_class_teacher";// asign class teacher
$route['class/manage/section_teacher']="class/manage_class/assign_section_teacher";// asign section teacher

$route['class/views']="class/views"; // list class table
$route['class/views/assign_class_teacher_box'] = "class/views/assign_class_teacher_box"; // assign teacher box
$route['class/views/assign_section_teacher_box'] = "class/views/assign_section_teacher_box"; // assign teacher box
$route['class/views/add_class_box'] = "class/views/add_class_box"; // add class box
$route['class/views/add_section_box'] = "class/views/add_section_box"; // add class box
$route['class/views/view_class_summary_box'] = 'class/views/view_class_summary_box';//class/views/view_class_summary_box
/* Add Section  */
//$route['class/section/add']="class/section_add";
$route['class/manage/add_section'] = "class/manage_class/add_section";
$route['class/attendance'] = "class/attendance";


// subjects
$route['subject/manage'] = 'subject/views'; // load UI
$route['subject/manage/add'] = 'subject/manage_subject/add_subject'; // add subject
$route['subject/manage/edit'] = 'subject/manage_subject/edit'; // edit subject
$route['subject/manage/delete'] = 'subject/manage_subject/delete'; // delete subject
$route['subject/manage/list_subject'] = 'subject/views/list_subject'; // send class and fetch subject name and id 
$route['subject/manage/assign_subject_teacher'] = 'subject/manage_subject/assign_subject_teacher'; // add subject
$route['subject/views/assign_subject_teacher_box'] = 'subject/views/assign_subject_teacher_box'; // Add box
$route['subject/views/add_subject_box'] = 'subject/views/add_subject_box'; // Add box


$route['subject/views/view_subject'] = 'subject/views/viewSubject'; // Add box
/////////////////////Mail//////////
$route['mail'] = 'mail/message';
$route['mail/compose'] = 'mail/message/compose';
$route['mail/read'] = 'mail/message/read';
$route['mail/send_item'] = 'mail/message/send_item';
$route['mail/notification']= 'mail/message/notification';
$route['mail/send'] = 'mail/message/send';



$route['exam/manage'] = "exam/examController/manage_exam";
$route['exam/manage/operation/(:any)'] = "exam/examController/type_operation/$1";

// Exam api
$route['api/exam/type'] = 'exam/examController/get_exam_type';
$route['exam/routine/download/(:num)/(:any)'] = 'exam/routine/download/$1/$2';

$route['exam/insert_marks'] = "exam/marksController";
$route['exam/insert_marks/operation/(:any)'] = "exam/marksController/operation/$1";

// Syllabus
$route['syllabus'] = "syllabus/manage";

// syllabus download
$route['syllabus/download/(:num)/(:any)'] = "syllabus/download/index/$1/$2";

// Material download
$route['study/download/(:num)/(:any)'] = "study/download/index/$1/$2";

// wildcard
$route['class/:any/:any'] = 'class/view_class/section_profile';
$route['class/:any'] = 'class/view_class/class_profile';
//$route['add_student']= 'students/add_student';
/* End of file routes.php */
/* Location: ./application/config/routes.php */