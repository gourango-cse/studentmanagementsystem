<?php
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
?>
<html>
    <head><title>Debug | SMS</title>
        <style type="text/css">
            body{
               background-color: #21272d;
    color: #bfb5b5;
            }    
            .center{
                text-align: center;

            }
            .heading{
                color: #D9D9D9;
            }
            .box{
                padding-left: 9%;
                margin-top: 3%;
                position: fixed;
                width: 80%;
                background-color: #e6e6e6;
                /* align-items: center; */
                height: 70%;
                margin-left: 5%;
                margin-right: 5%;
                padding-top: 2%;
                border: white;
                border-left-style: inset;
                color: black;
                    z-index: -1111;
            }
            .footer{
                position: fixed;
                margin-top: 43%;
                margin-left: 5%;
                width: 50%;
                color: cyan;
                font-style: oblique;
                font-family: monospace;
                font-size: medium;
                font-weight: normal;
            }
        </style>

    </head>
    <body>
        <h2 class="center heading">School Management System Debugging Mode</h2>



        <code class="box">
<?php
 echo $debug;
?>

        </code>
        <i class="footer">Dubugging Mode | SMS | NBPI | APRS</i>

</html>
