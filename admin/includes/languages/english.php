<?php 
    
    function lang( $phrase ) {

        static $lang = array(

            // Navbar Links 

            'HOME_ADMIN' => 'HOME' ,
            'Categories' => 'CATEGORIES' ,
            'ITEMS'      => 'ITEMS' ,
            'MEMBERS'    => 'MEMBERS' ,
            'COMMENTS'   => 'COMMENTS',
            'STATISTICS' => 'STATISTICS',
            'LOGS'       => 'LOGS',  
            '' => '',
            '' => '',
            '' => '',
            '' => '',
        );
        
        return $lang[$phrase] ; 
    }
    

