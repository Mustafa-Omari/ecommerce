<?php 

    /*
    ==================================================
    == Manage Members Page 
    == You Can Add | Edit | Delete Members From Here 
    ==================================================
    */

    session_start();

    $pageTitle = 'Members' ; 

    if (isset($_SESSION['Username'])){
        
        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // ifset($_GET['do']{ $do =$_GET['do'];}

        // Start Manage Page 

        if ( $do == 'Manage') { // Manage Members Page 

            $query = '' ; 

            if(isset($_GET['page']) && $_GET['page'] == "Pending") {

                $query = 'AND RegStatus = 0' ; 
            }

            // Select All Users Except Admin 
            $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query ORDER BY UserID DESC "); 
            
            // Execute The Statment 
            $stmt->execute();

            // Assign To Variable 
            $rows = $stmt->fetchAll();

            if (! empty ($rows)) { 
        
        ?>  
            
            <h1 class="text-center" >Manage Members </h1>
            <div class="container"> 
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                            <td>#ID</td>
                            <td>Username</td>
                            <td>Email</td>
                            <td>Full Name</td>
                            <td>Registerd Date</td>
                            <td>Control</td>
                        </tr>

                        <?php  

                            foreach($rows as $row) { 
                               
                                echo "<tr>";
                                    echo "<td>" . $row['UserID'] . "</td>";
                                    echo "<td>" . $row['Username'] . "</td>";
                                    echo "<td>" . $row['Email'] . "</td>";
                                    echo "<td>" . $row['Fullname']  . "</td>" ;
                                    echo "<td>" . $row['Date'] . "</td>"; 
                                    echo '<td>
                                            <a href="members.php?do=Edit&userid=' . $row['UserID'] . '" class="btn btn-success"><i class="fa fa-edit"></i> Edit </a>
                                            <a href="members.php?do=Delete&userid=' . $row['UserID'] . '" class="btn btn-danger confirm"><i class="delete fas fa-times"></i> Delete </a>';           

                                            if($row['RegStatus'] == 0 ) {

                                                echo '<a 
                                                        href="members.php?do=Activate&userid=' . $row['UserID'] . '" 
                                                        class="btn btn-info activate">
                                                        <i class="active fas fa-check"></i> Activate 
                                                    </a>';
                                            }

                                    echo '</td>' ;  
                                echo "</tr>"; 
                            }
                            

                            ?>
                        
                        
                    </table>
                </div>
                <a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> New Members</a>
            </div>

            <?php  }  else { 
                echo '<div class="container">'; 
                    echo '<div class="nice-message"> There is No Recored To Show </div>' ;
                    echo '<a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> New Members</a>'; 
                echo '</div>' ; 
            }


            ?>

        <?php 
        } elseif($do == 'Add'){  // Add Members Page  ?>
             
            <h1 class="text-center" > Add New  Member </h1>

            <div class="container"> 
                <form class="form-horizontal" action="?do=Insert" method="POST">
                    <!-- Start Username Field  -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10 col-md-6  d-inline-block">
                            <input type="text" name="username"  class="form-control"  autocomplete="off" required="required" placeholder="UserName To Login Into Shop ">
                        </div>                     
                    </div>
                    <!-- End Username Field  -->
                    <!-- Start Password Field  -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10 col-md-6  d-inline-block">
                            <input type="password" name="password" class="password form-control" autocomplete="new-password" required="required" placeholder="Must Be Hard And Complex">
                            <i class="show-pass fa fa-eye fa-2x"></i>
                        </div>                     
                    </div>
                    <!-- End Password Field  -->
                    <!-- Start Email Field  -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10 col-md-6 d-inline-block">
                            <input type="email" name="email" class="form-control" required="required" placeholder="Email Must Be Valid">
                        </div>                     
                    </div>
                    <!-- End Email Field  -->
                    <!-- Start Full Name Field  -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Full Name</label>
                        <div class="col-sm-10 col-md-6 d-inline-block">
                            <input type="text" name="full" class="form-control" required="required" placeholder="FullName Appear In Your Profile Page ">
                        </div>                     
                    </div>
                    <!-- End Full Name Field  -->
                    <!-- Start Submit Field  -->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10 col-md-6">
                            <input type="submit" value="Add Member" class="btn btn-primary">
                        </div>                     
                    </div>
                    <!-- End Submit Field  -->
                </form>
            </div> 

            <?php
            
        }elseif($do == "Insert") {
            // Insert Member Page 

 
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                 echo  "<h1 class='text-center'>Insert Member</h1>" ;
                 echo "<div class='container'>" ;
 
                 // Get Variables From The Form 
 
                 $user = $_POST['username'] ; 
                 $pass = $_POST['password'] ; 
                 $email = $_POST['email'] ; 
                 $name = $_POST['full'] ; 
                 
                 $hashPass = sha1($_POST['password']);
                 
 
                 // Validate The Form 
 
                 $formErrors = array(); 
 
                 if(strlen($user)  < 4) { 
                     $formErrors[] = ' Username Cant Be Less Than <strong> 4 Characters </strong>' ; 
                 }
                 if(strlen($user) > 20 ) { 
                     $formErrors[] = ' Username Cant Be More Than <strong> 20 Characters  </strong>' ;
                 }
                 if (empty($user)) {
                     $formErrors[] = ' Username Cant Be <strong> Empty </strong>' ; 
                 }
                 if (empty($pass)) {
                    $formErrors[] = ' Password Cant Be <strong> Empty </strong>' ; 
                 }
                 if (empty($name)) {
                     $formErrors[] = ' FullName Cant Be <strong> Empty </strong>' ; 
                 }
                 if (empty($email)) {
                     $formErrors[] = ' Email Cant Be <strong> Empty </strong>' ; 
                 }
 
                 // Loop Into Errors Array And Echo It 
 
                 foreach($formErrors as $error) { 
                     echo '<div class="alert alert-danger">' .  $error  . '</div>'; 
                 }
 
                  /*
                  $pass = ''; 
                  if(empty($_POST['newpassword'])) {
                     $pass = $_POST['oldpassword'];      
                   }else { 
                     $pass = sha1($_POST['newpassword']); 
                   }
                  */
 
                 // Chek If There Is No Error Proceed The Update Operation 
 
                 if(empty($formErrors)) {
 
                    // Check If User Exist In Database 

                    $check = checkItem("Username" , "users" , $user);
                    
                    if ($check == 1 ) {
                        
                        echo '<div class="container">' ; 

                        $theMsg = '<div class="alert alert-danger"> Sorry This User Is Exist </div>' ; 

                        redirectHome($theMsg , 'Back') ;

                        echo '</div>' ; 
                    }else {
                       
                        // Insert User Info In Database 
                        
                        $stmt = $con->prepare("INSERT INTO
                                            users(Username , Password , Email , Fullname , RegStatus ,Date)
                                            VALUES(:zueser , :zpassword , :zemail , :zname , 1 , now()) ");
                        $stmt->execute(array(
                            'zueser' => $user , 
                            'zpassword' => $hashPass , 
                            'zemail'=> $email , 
                            'zname' => $name
                        ));  

                        // Echo Success Message  
    
                        $theMsg =  "<div class='alert alert-success'>" .  $stmt->rowCount() . ' Recored Inserted ' ."</div>" ; 

                        redirectHome($theMsg , 'back') ; 
                    }

                }
             }else {
                echo '<div class="container">' ;

                $theMsg  = '<div class="alert alert-danger"> Sorry You Cant Browes This Page Directly </div>' ;

                redirectHome($theMsg) ;
                
                echo '</div>'; 
            }
 
             echo '</div>'; 
         


        }elseif($do == 'Edit') {  // Edit Page 

            // Check If Get Request userid Is Numeric  && Get The Integer Value If It 

            //if (isset($_GET['userid']) && is_numeric($_GET['userid'])) {

            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ?  intval($_GET['userid']) : 0 ; 
                
            // Select All Data Depentd On This ID
          
            $stmt = $con->prepare("SELECT *
                               FROM users 
                               WHERE UserID = ?
                               LIMIT 1 ") ; 
            // Execute Query 
            $stmt->execute(array($userid)) ; 
            // Fetch The Data 
            $row = $stmt->fetch(); 
            // The Row Count 
            $count = $stmt->rowCount(); 
            // If There IS Such ID Show The Form 
            if($count > 0 ) { ?>

                <h1 class="text-center" >Edit Member </h1>

                <div class="container"> 
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="userid" value="<?php echo $userid ?>">
                        <!-- Start Username Field  -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10 col-md-6  d-inline-block">
                                <input type="text" name="username"  class="form-control" value="<?php echo $row['Username'] ?>" autocomplete="off" required="required">
                            </div>                     
                        </div>
                        <!-- End Username Field  -->
                        <!-- Start Password Field  -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10 col-md-6  d-inline-block">
                                <input type="hidden" name="oldpassword" value="<?php echo $row['Password']; ?>">
                                <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Lank If You Dont Want To Change">

                            </div>                     
                        </div>
                        <!-- End Password Field  -->
                        <!-- Start Email Field  -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10 col-md-6 d-inline-block">
                                <input type="email" name="email" class="form-control" value="<?php echo $row['Email'] ?>" required="required">
                            </div>                     
                        </div>
                        <!-- End Email Field  -->
                        <!-- Start Full Name Field  -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Full Name</label>
                            <div class="col-sm-10 col-md-6 d-inline-block">
                                <input type="text" name="full" class="form-control" value="<?php echo $row['Fullname'] ?>" required="required">
                            </div>                     
                        </div>
                        <!-- End Full Name Field  -->
                        <!-- Start Submit Field  -->
                        <div class="form-group form-group-lg">
                            <div class="col-sm-offset-2 col-sm-10 col-md-6">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>                     
                        </div>
                        <!-- End Submit Field  -->


                    </form>
                </div> 

         <?php
            // Else If There IS No Such ID ,,  Show Error Message 

            } else { 
                echo '<div class="container">' ; 

                $theMsg =  '<div class="alert alert-danger"> There Is No Such ID </div>' ; 

                redirectHome($theMsg) ; 
                echo '</div>' ; 
            }
        
        } elseif($do == 'Update') { // Update Page 
           
           echo "<h1 class='text-center'>Update Member</h1>" ;
           echo "<div class='container'>" ; 
 

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Get Variables From The Form 

                $id = $_POST['userid'] ;
                $user = $_POST['username'] ; 
                $email = $_POST['email'] ; 
                $name = $_POST['full'] ; 
                
                // Password Trick 

                // Condition ? True : False ;

                $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']); // nafs eli ta7t   

                // Validate The Form 

                $formErrors = array(); 
 
                if(strlen($user)  < 4) { 
                    $formErrors[] = ' Username Cant Be Less Than <strong> 4 Characters </strong>' ; 
                }
                if(strlen($user) > 20 ) { 
                    $formErrors[] = ' Username Cant Be More Than <strong> 20 Characters  </strong>' ;
                }
                if (empty($user)) {
                    $formErrors[] = ' Username Cant Be <strong> Empty </strong>' ; 
                }
                if (empty($name)) {
                    $formErrors[] = ' FullName Cant Be <strong> Empty </strong>' ; 
                }
                if (empty($email)) {
                    $formErrors[] = ' Email Cant Be <strong> Empty </strong>' ; 
                }

                // Loop Into Errors Array And Echo It 

                foreach($formErrors as $error) { 
                    echo '<div class="alert alert-danger">' .  $error  . '</div>'; 
                }
                 /*
                 $pass = ''; 
                 if(empty($_POST['newpassword'])) {
                    $pass = $_POST['oldpassword'];      
                  }else { 
                    $pass = sha1($_POST['newpassword']); 
                  }
                 */

                // Chek If There Is No Error Proceed The Update Operation 

                if(empty($formErrors)) {

                    $stmt2 = $con->prepare("SELECT
                                                *
                                            FROM 
                                                users
                                            WHERE
                                                Username  = ? 
                                            AND 
                                                UserID != ?") ;
                    
                    $stmt2->execute(array($user ,$id)) ; 

                    $count = $stmt2->rowCount(); 

                    if ( $count == 1 ) { 

                       
                        echo '<div class="container">' ;
                            $theMsg =  '<div class="alert alert-danger"> Sorry This User Is Exists </div>' ; 
                            redirectHome($theMsg , 'back') ; 
                        echo '<div>' ;

                    } else { 

                        // Update The Database With This Info 

                        $stmt = $con->prepare("UPDATE users SET Username = ? , Email = ? , Fullname = ? , Password= ? WHERE UserID= ?");
                        $stmt->execute(array($user , $email , $name , $pass , $id)) ; 

                        // Echo Success Message  

                        $theMsg =  "<div class='alert alert-success'>" .  $stmt->rowCount() . ' Recored Updated ' ."</div>" ;
                        
                        echo '<div class="container">' ;

                        redirectHome($theMsg , 'back') ; 

                        echo '<div>' ; 
                    }
                }

                
            }else {


                echo '<div class="container">' ;

                $theMsg  = '<div class="alert alert-danger"> Sorry You Cant Browes This Page Directly </div>' ;

                redirectHome($theMsg) ;
                
                echo '</div>'; 
            }

            echo '</div>'; 
        } elseif($do == 'Delete') { // Delete Member Page

            echo "<h1 class='text-center'>Delete Member</h1>" ;
            echo "<div class='container'>" ; 
 
                // Check If Get Request userid Is Numeric  && Get The Integer Value If It 

                $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ?  intval($_GET['userid']) : 0 ; 
                    
                // Select All Data Depentd On This ID

                /*  bdltha b functuon el checkItem 
                $stmt = $con->prepare("SELECT *
                                FROM users 
                                WHERE UserID = ?
                                LIMIT 1 ") ; 
                */

                $check = checkItem($userid , 'users' , $userid) ; 

                // Execute Query  bdltha b functuon el checkItem 
                // $stmt->execute(array($userid)) ; 

                // The Row Count  bdltha b functuon el checkItem 
                // $count = $stmt->rowCount(); 

                // If There IS Such ID Show The Form 
                if($check > 0 ) {

                    $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");

                    $stmt->bindParam(":zuser" , $userid); // bindParam btrbu6 sha3'lten bb3a9'

                    $stmt->execute();

                    $theMsg =  "<div class='alert alert-success'>" .  $stmt->rowCount() . ' Recored Deleted ' ."</div>" ; 

                    redirectHome($theMsg , 'back'); 

                } else { 
                    
                    echo '<div class="container">' ; 

                    $theMsg =  '<div class="alert alert-danger"> This ID Is Not Exist </div>' ; 

                    redirectHome($theMsg) ; 

                    echo '</div>' ; 
                }
            echo '</div>'; 
        } elseif ( $do = 'Activate') {


            echo "<h1 class='text-center'>Activate Member</h1>" ;
            echo "<div class='container'>" ; 
 
                // Check If Get Request userid Is Numeric  && Get The Integer Value If It 

                $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ?  intval($_GET['userid']) : 0 ; 
                    
                // Select All Data Depentd On This ID

                /*  bdltha b functuon el checkItem 
                $stmt = $con->prepare("SELECT *
                                FROM users 
                                WHERE UserID = ?
                                LIMIT 1 ") ; 
                */

                $check = checkItem($userid , 'users' , $userid) ; 

                // Execute Query  bdltha b functuon el checkItem 
                // $stmt->execute(array($userid)) ; 

                // The Row Count  bdltha b functuon el checkItem 
                // $count = $stmt->rowCount(); 

                // If There IS Such ID Show The Form 
                if($check > 0 ) {

                    $stmt = $con->prepare("UPDATE  users SET RegStatus = 1 WHERE UserID = ? ");

                    $stmt->execute(array($userid));

                    $theMsg =  "<div class='alert alert-success'>" .  $stmt->rowCount() . ' Recored Activated ' ."</div>" ; 

                    redirectHome($theMsg); 

                } else { 
                    
                    echo '<div class="container">' ; 

                    $theMsg =  '<div class="alert alert-danger"> This ID Is Not Exist </div>' ; 

                    redirectHome($theMsg , 'back') ;

                    echo '</div>' ; 
                }
            echo '</div>'; 


        }


        include $tpl . 'footer.php' ; 

    } else {

        header('Location : index.php');
        
        exit();
    }