<?php 

    /*
        Categories => [ Manage | Edit | Update | Add | Insert | Delete | Stats ]
        Condition ? True : False 
    */

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; // nafs el if elita7t 
    // if(isset($_GET['do'])) {
    //    $do =  $_GET['do'];
    // }else {
    //     $do = 'Manage'; 
    // }

    // If The Page Is Main Page 

    if ($do == 'Manage') {
       echo 'Welcome You Are In Manage Category Page'; 
       echo '<a href="page.php?do=Add">Add New Category +</a>' ; 
    } elseif($do == 'Add'){
        echo 'Welcome You Are In Add Category Page'; 
    }elseif($do =='Insert'){
        echo 'Welcome You are In Insert Page' ;
    }else {
        echo 'Error There\' No Page With This Name ' ;
    }