<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!
?>

Welcome to School Management System!  Your account is created on our system!
Please verify it and change your password!

Your information>>

Account Type: <?php  echo $row->role;?>.
Full Name: <?php  echo $row->full_name;?>.
Contact : <?php  echo $row->contact; ?>.
Address:  <?php  echo $row->address; ?>.

----------------------------------------
Your username: <?php echo $username ;?>     
Your password: <?php  echo $password; ?>    
----------------------------------------



Your verification code: <?php  echo $ver_code; ?>


====>Verification Link <=====
<?php  echo $link; ?>



Please change your password after verifying your account!

Thank You!

School Management System