<?php

    ob_start() ; // Output Buffering Start  // lazim tkun gabl el session

    session_start();

    if (isset($_SESSION['Username'])){

        $pageTitle = 'Dashboard' ;

        include 'init.php';


        /* Start Dashboard Page */

        $numUsers = 6 ;  // Number Of Latests Users

        $latestUsers = getLatest( '*' , 'users' , 'UserID', $numUsers) ; // Latest Users Array

        $numItems = 6 ;  // Number Of Latest Items

        $latestItems = getLatest('*' , 'items' , 'Item_ID' , $numItems ) ;  // Latest Items Array

        $numComments = 4 ; // Number Of Comments 
        ?>

        <div class="container home-stats text-center">
            <h1> Dashboard </h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat st-members">
                        <i class="fas fa-users"></i>
                        <div class="info">
                            Totlal Members
                            <span>
                                <a href="members.php"><?php echo  countItems('UserID' , 'users') ?></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-pending">
                        <i class="fas fa-user-check"></i>
                        <div class="info">
                            Pending Members
                            <span>
                                <a href="members.php?do=Manage&page=Pending">
                                <?php echo checkItem("RegStatus" , "users" , 0)  ?></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-items">
                        <i class="fas fa-tag"></i>
                        <div class="info">
                            Total Items
                            <span><a href="items.php"><?php echo  countItems('Item_ID' , 'items') ?></a></span>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="stat st-comments">
                        <i class="fas fa-comments"></i>
                        <div class="info">
                            Totlal Comments
                            <span><a href="comments.php"><?php echo  countItems('Comm_ID' , 'comments') ?></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container latest">
            <div class="row">
                <!-- Start Latest Members -->
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-users"></i>
                            Latest <?php echo  $numUsers ?> Registerd Users
                            <span class="toggle-info float-right">
                                <i class="fa fa-minus fa-lg"></i>
                            </span>
                        </div>
                        <div class="card-body">
                                <ul class="list-unstyled latest-users">
                                <?php

                                    if(!empty ($latestUsers)) { 
                                        foreach($latestUsers as $user) {

                                            echo '<li>' ;
                                                echo $user['Username']  ;
                                                echo '<a href="members.php?do=Edit&userid= ' . $user['UserID'] . '" >' ;
                                                    echo ' <span class="btn btn-success float-right"> ' ;
                                                        echo '<i class="fa fa-edit"></i> Edit ' ;
                                                        if($user['RegStatus'] == 0 ) {

                                                            echo '<a href="members.php?do=Activate&userid=' . $user['UserID'] . '" class="btn btn-info activate float-right"><i class="active fas fa-check"></i> Activate </a>';
                                                        }
                                                    echo '</span>' ;
                                                echo '</a>' ;
                                            echo '</li>';
                                        }
                                    } else { 
                                        echo ' There Is No Members To Show ' ; 
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Latest Members  -->
                <!-- Start Latest Items  -->
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-tag"></i> Latest <?php echo $numItems ?> Items
                            <span class="toggle-info float-right">
                                <i class="fa fa-minus fa-lg"></i>
                            </span>
                        </div>
                        <div class="card-body">

                        <ul class="list-unstyled latest-users">
                                <?php
                                    if (!empty ($latestItems)) { 
                                        foreach($latestItems as $item) {


                                            echo '<li>' ;
                                                echo $item['Name'] ;
                                                echo '<a href="items.php?do=Edit&itemid=' . $item['Item_ID']  .  '" >' ;
                                                    echo '<span class="btn btn-success float-right">' ;
                                                        echo '<i class="fa fa-edit"></i> Edit' ;
                                                        if($item['Approve'] == 0) {
                                                            echo '<a href="items.php?do=Approve&itemid=' . $item['Item_ID'] . '"
                                                            class="btn btn-info activate float-right">
                                                            <i class="active fas fa-check"></i> Approve </a>';
                                                        }
                                                        echo '</span>' ;
                                                    echo '</a>' ;
                                            echo '</li>' ;

                                        }
                                    } else { 
                                        echo ' There Is No Items To Show ' ; 
                                    }

                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                <!-- End Latest Items  -->
                <!--  Start Latest Comments -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-comments"></i>
                                Latest <?php echo $numComments; ?> Comments 
                                <span class="toggle-info float-right">
                                    <i class="fa fa-minus fa-lg"></i>
                                </span>
                            </div>
                            <div class="card-body">
                                <?php 
                                    // Select All Users Except Admin 
                                    $stmt = $con->prepare("SELECT 
                                                                comments.* , users.Username AS Member
                                                        FROM 
                                                                comments 
                                                        INNER JOIN 
                                                                users 
                                                        ON 
                                                                users.UserID  = comments.User_ID
                                                        ORDER BY 
                                                            Comm_ID DESC 
                                                        LIMIT 
                                                            $numComments "); 
                                    
                                    $stmt->execute();
                                    $comments = $stmt->fetchAll();
                                    if(!empty ($comments)) { 
                                        foreach($comments as $comment) {
                                            echo '<div class="comment-box">';
                                                echo '<span class="member-n"><a href="members.php?do=Edit&userid=' . $user['UserID'] . '">' . $comment['Member'] . '</a>' ; 
                                                
                                                echo '</span>' ;
                                                
                                                echo '<p class="member-c">' . $comment['Comment']  ; 
                                                if ($comment['Status'] == 0 ){
                                                    echo '<a href="comments.php?do=Approve&comid=' . $comment['Comm_ID'] . '" class="btn-app btn btn-primary btn-sm float-right"><i class="fa fa-check"></i> Approve</a>' ; 
                                                }


                                                
                                                
                                                echo '</p>' ;
                                            echo '</div>' ; 
                                        }
                                    } else { 
                                        echo ' There Is No Comments To Show ' ; 
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  End Latest Comments -->

            </div>
        </div>


        <?php

        /* End Dashboard Page  */


        include $tpl . 'footer.php' ;



    } else {

        header('Location : index.php');

        exit();
    }

    ob_end_flush() ; // End ob

?>