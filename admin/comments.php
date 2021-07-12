<?php 

    /*
    ==================================================
    == Manage Coments Page 
    == You Can  Edit | Delete  | Approve  Comments  From Here 
    ==================================================
    */

    session_start();

    $pageTitle = 'Comments' ; 

    if (isset($_SESSION['Username'])){
        
        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // ifset($_GET['do']{ $do =$_GET['do'];}

        // Start Manage Page 

        if ( $do == 'Manage') { // Manage Members Page 

            // Select All Users Except Admin 
            $stmt = $con->prepare("SELECT 
                                        comments.* , items.Name AS Item_Name, users.Username AS Member
                                   FROM 
                                        comments 
                                   INNER JOIN 
                                        items 
                                   ON 
                                        items.item_ID = comments.Item_ID
                                   INNER JOIN 
                                        users 
                                   ON 
                                        users.UserID  = comments.User_ID
                                   ORDER BY 
                                    Comm_ID DESC
                                    "); 
            
            // Execute The Statment 
            $stmt->execute();

            // Assign To Variable 
            $comments = $stmt->fetchAll();

            if( ! empty($comments )){
            
            ?>  
                
                <h1 class="text-center" >Manage Comments </h1>
                <div class="container"> 
                    <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">
                            <tr>
                                <td>#ID</td>
                                <td>Comment</td>
                                <td>Item Name</td>
                                <td>User Name</td>
                                <td>Added Date</td>
                                <td>Control</td>
                            </tr>

                            <?php  

                                foreach($comments as $comment) { 
                                
                                    echo "<tr>";
                                        echo "<td>" . $comment['Comm_ID'] . "</td>";
                                        echo "<td>" . $comment['Comment'] . "</td>";
                                        echo "<td>" . $comment['Item_Name']  . "</td>" ;
                                        echo "<td>" . $comment['Member'] . "</td>"; 
                                        echo "<td>" . $comment['Comm_Date'] . "</td>";
                                        echo '<td>
                                                <a href="comments.php?do=Edit&comid=' . $comment['Comm_ID'] . '" class="btn btn-success"><i class="fa fa-edit"></i> Edit </a>
                                                <a href="comments.php?do=Delete&comid=' . $comment['Comm_ID'] . '" class="btn btn-danger confirm"><i class="delete fas fa-times"></i> Delete </a>';           

                                                if($comment['Status'] == 0 ) {

                                                    echo '<a 
                                                            href="comments.php?do=Approve&comid=' . $comment['Comm_ID'] . '" 
                                                            class="btn btn-info activate">
                                                            <i class="active fas fa-check"></i> Approve 
                                                        </a>';
                                                }

                                        echo '</td>' ;  
                                    echo "</tr>"; 
                                }
                                

                                ?>
                            
                            
                        </table>
                    </div>
                </div>
            <?php  }  else { 
                echo '<div class="container">'; 
                    echo '<div class="nice-message"> There is No Comment To Show </div>' ;
                echo '</div>' ; 
            }
            ?>
        <?php 
        
        } elseif($do == 'Edit') {  // Edit Page 

            // Check If Get Request comid Is Numeric  && Get The Integer Value If It 

            $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ?  intval($_GET['comid']) : 0 ; 
                
            // Select All Data Depentd On This ID
          
            $stmt = $con->prepare("SELECT *
                               FROM comments 
                               WHERE Comm_ID  = ? ") ; 
            // Execute Query 
            $stmt->execute(array($comid)) ; 
            // Fetch The Data 
            $row = $stmt->fetch(); 
            // The Row Count 
            $count = $stmt->rowCount(); 
            // If There IS Such ID Show The Form 
            if($count > 0 ) { ?>

                <h1 class="text-center" >Edit Comment </h1>

                <div class="container"> 
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="comid" value="<?php echo $comid ?>">
                        <!-- Start Comment Field  -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Comment</label>
                            <div class="col-sm-10 col-md-6  d-inline-block">
                                <textarea class="form-control" name="comment"><?php echo $row['Comment'] ?></textarea>
                            </div>                     
                        </div>
                        <!-- End Comment Field  -->
                        
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
           
           echo "<h1 class='text-center'>Update Comment</h1>" ;
           echo "<div class='container'>" ; 
 

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Get Variables From The Form 

                $comid = $_POST['comid'] ;
                $comment = $_POST['comment'] ; 
                
                // Update The Database With This Info 

                $stmt = $con->prepare("UPDATE comments SET Comment = ? WHERE Comm_ID  = ?");
                $stmt->execute(array($comment  , $comid)) ; 

                // Echo Success Message  

                $theMsg =  "<div class='alert alert-success'>" .  $stmt->rowCount() . ' Recored Updated ' ."</div>" ;
                
                echo '<div class="container">' ;

                redirectHome($theMsg , 'back') ; 

                echo '<div>' ; 
                
            }else {


                echo '<div class="container">' ;

                $theMsg  = '<div class="alert alert-danger"> Sorry You Cant Browes This Page Directly </div>' ;

                redirectHome($theMsg) ;
                
                echo '</div>'; 
            }

            echo '</div>'; 
        } elseif($do == 'Delete') { // Delete Comment Page

            echo "<h1 class='text-center'>Delete Comment</h1>" ;
            echo "<div class='container'>" ; 
 
                // Check If Get Request comid Is Numeric  && Get The Integer Value If It 

                $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ?  intval($_GET['comid']) : 0 ; 
                    
                // Select All Data Depentd On This ID

                $check = checkItem('Comm_ID' , 'comments' , $comid) ; 

                // If There IS Such ID Show The Form 
                if($check > 0 ) {

                    $stmt = $con->prepare("DELETE FROM comments WHERE Comm_ID = :zid");

                    $stmt->bindParam(":zid" , $comid); // bindParam btrbu6 sha3'lten bb3a9'

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
        } elseif ( $do == 'Approve') {



            echo "<h1 class='text-center'>Approve Comment</h1>" ;
            echo "<div class='container'>" ; 
 
                // Check If Get Request comid Is Numeric  && Get The Integer Value If It 

                $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ?  intval($_GET['comid']) : 0 ; 
                    
                // Select All Data Depentd On This ID


                $check = checkItem('Comm_ID' , 'comments' , $comid) ; 

                // If There IS Such ID Show The Form 
                if($check > 0 ) {

                    $stmt = $con->prepare("UPDATE comments SET Status = 1 WHERE Comm_ID = ? ");

                    $stmt->execute(array($comid));

                    $theMsg =  "<div class='alert alert-success'>" .  $stmt->rowCount() . ' Recored Approved ' ."</div>" ; 

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