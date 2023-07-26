<!-- Visit "codeastro.com" for more projects! -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Developed by</b> <a data-toggle="modal" data-target=".siteinfo" >ARPS</a>
    </div>
    <strong>Current Session: <?php echo $this->sms->running_session()->session; ?> >> <a data-toggle="modal" data-target=".siteinfo"> School Management System </a> - PHP CodeIgniter</strong> 
</footer>

<div class="modal  fade siteinfo" tabindex="-1" role="dialog" aria-labelledby="profilepicture">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">School Management System - PHP CodeIgniter Project</h4>
            </div>
            <div class="modal-body">
                <p>Education system forms the backbone of every nation. And hence it is important to provide a strong educational foundation to the young generation to ensure the development of open-minded global citizens securing the future for everyone. Advanced technology available today can play a crucial role in streamlining education-related processes to promote solidarity among students, teachers, parents and the school staff. </p>
                <br>
                <pre>
				Objectives of SMS: 


				  To facilitate attendance record keeping,
				  To facilitate online noticeboard,
				  To facilitate information about books on library.
				  To facilitate transportation route information,
				  To facilitate dormitory information,
				  To provide fee information. 
				  To allow teachers, parents and school community to view exam marks of students,
				  To facilitate academic syllabus,
				  To facilitate studying material to student’s,  
				  To generate a timetable,
				  To communicate instantly with school community.

                </pre>

                <hr>

                <p>This System is developed by ARPS .(Amrit, Ronash, Pratik, Saroj - Team)</p>
               

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  pull-right  btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Visit "codeastro.com" for more projects! -->
 <script type="text/javascript">
                    $(document).ready(function(){
                         $.ajax({
                            url: '<?php echo base_url('session/count_unread') ?>',
                            type: 'GET',
                            dataType: 'text',
                            cache: false,
                            success: function (result) {
                                  $('#count_msg').empty();
                                $('#count_msg').append(result);
                                  $('#count_msg1').empty();
                                $('#count_msg1').html('You have '+result+' message');
                                  $('#count_msg3').empty();
                                $('#count_msg3').append(result);
                                
                                if(result!=0){
                                    $('#count_msg4').empty();
                                     $('#count_msg4').append(result+' New Message');
                                }
                                
                               
                            }
                        });
                    });
                    
                    //// mail notification
                  
                    <!-- Visit "codeastro.com" for more projects! -->
                </script>