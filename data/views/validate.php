<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */


?>

<!DOCTYPE html>
<html>
<head>
<title>Validating Form Fields Using CodeIgniter</title>
<link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
<link href="http://localhost/CodeIgniter/css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
<?php echo form_open('validate_ctr'); ?>
<h1>Validating form fields using CodeIgniter</h1>
<?php echo form_label('Student Name :'); ?><?php echo form_error('dname'); ?>
<?php echo form_input(array('id' => 'dname', 'name' => 'dname')); ?>
<?php echo form_label('Student Email :'); ?> <?php echo form_error('demail'); ?>
<?php echo form_input(array('id' => 'demail', 'name' => 'demail')); ?>
<?php echo form_label('Student Mobile No. :'); ?> <?php echo form_error('dmobile'); ?>
<?php echo form_input(array('id' => 'dmobile', 'name' => 'dmobile','placeholder'=>'10 Digit Mobile No.')); ?>
<?php echo form_label('Student Address :'); ?> <?php echo form_error('daddress'); ?>
<?php echo form_input(array('id' => 'daddress', 'name' => 'daddress')); ?>
<?php echo form_submit(array('id' => 'submit', 'value' => 'Submit')); ?> <?php echo form_close(); ?>
</div>
</body>
</html>