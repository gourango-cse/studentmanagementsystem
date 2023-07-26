<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 
?>
<!-- Visit "codeastro.com" for more projects! -->

<div class="box">
    <div class="box-header text-center">
        <?= $subject->name; ?> Marksheet
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th>Student</th>
                <th>Marks</th>
                
            </tr>
            <?php foreach ($marks as $mark){?>
            <tr>
                <td><?= $this->sms->get_user($mark->student_id)->full_name; ?></td>
                <td><?php if($mark->marks < 40 ) { 
                    echo $mark->marks."<b style='color: #e10000;'> Failed</b>"; 
                    } else { 
                        echo "$mark->marks";}?>
                        </td>
            </tr>
            <?php } ?>
        </table> 
    </div>
</div>