<?php  

/*
============================================
== Category Page
============================================
*/

ob_start() ;  // Output Buffering Start

session_start(); 

$pageTitle= 'Categories' ; 

if(isset($_SESSION['Username'])) {

    include 'init.php' ; 

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ; 
    
    if($do == 'Manage') { 
        
        $sort = 'ASC' ; 

        $sort_array = array('ASC' , 'DESC') ;

        if (isset($_GET['sort']) && in_array($_GET['sort'] , $sort_array)) { 

            $sort = $_GET['sort'] ; 
        }
        
        $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY Ordering $sort") ; 

        $stmt2->execute() ;
        
        $cats = $stmt2->fetchAll() ; 
        ?>

        <h1 class="text-center">Manage Categories </h1>
        <div class="container categories">
            <div class="card">
                <div class="card-header">
                    <i class="far fa-edit"></i> Manage Categories
                    <div class="option float-right">
                        <i class="fas fa-sort"></i> Ordering : [
                        <a class="<?php if($sort == 'ASC') { echo 'active' ; } ?>" href="?sort=ASC"><i class="fas fa-arrow-up"></i></a> |
                        <a class="<?php if($sort == 'DESC') { echo 'active' ;  } ?>" href="?sort=DESC"><i class="fas fa-arrow-down"></i></a>]
                        <i class="far fa-eye"></i> View : [
                        <span class="active" data-view="full">Full</span> |
                        <span data-view="classic"> Classic</span> ]
                    </div> 
                </div>
                <div class="card-body>">
                     <?php 

                        foreach($cats as $cat) {
                            echo "<div class='cat'>" ;
                                echo "<div class='hidden-buttons'>" ;
                                    echo "<a href='categories.php?do=Edit&catid=" . $cat['ID'] .  "' class='btn btn-primary'> <i class='far fa-edit'></i> Edit</a>";
                                    echo "<a href='categories.php?do=Delete&catid=" . $cat['ID'] . "' class='btn btn-danger confirm'> <i class='far fa-window-close'></i> Delete</a>";
                                echo "</div>" ; 
                                echo '<h3>' . $cat['Name'] . '</h3>';
                               
                                echo '<div class="full-view">' ; 
                                    echo "<p>" ; 
                                        if($cat['Description'] == ''){echo 'This category has no description' ;} else {echo $cat['Description'] ;}
                                    echo "</p>";
                                    if($cat['Visiblity']  == 1) { echo '<span class="visibilty"><i class="far fa-eye"></i> Hidden </span>';  }  
                                    if($cat['Allow_Comment']  == 1) { echo '<span class="commenting"><i class="far fa-window-close"></i> Comment Disabled  </span>';  }  
                                    if($cat['Allow_Ads']  == 1) { echo '<span class="advertises"><i class="far fa-window-close"></i> Ads Disabled </span>';  }  
                                echo '</div>' ;   
                            echo '</div>' ; 
                            echo '<hr>' ; 
                            }
                     
                     ?>
                </div>
            </div>
            <a class="add-category btn btn-primary" href="categories.php?do=Add"><i class="fa fa-plus"></i> Add New Category</a>
        </div>


        <?php
    
    }elseif($do == 'Add') { ?>
        
        <h1 class="text-center" > Add New  Categories </h1>

        <div class="container"> 
            <form class="form-horizontal " action="?do=Insert" method="POST">
                <!-- Start Name Field  -->
                <div class="form-group form-group-lg ">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 col-md-6  d-inline-block">
                        <input type="text" name="name"  class="form-control"  autocomplete="off" 
                        required="required" placeholder="Name Of The Categories ">
                    </div>                     
                </div>
                <!-- End Name Field  -->
                <!-- Start Description Field  -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-6  d-inline-block">
                        <input type="text" name="description" class="form-control" placeholder="Describe The Category">
                    </div>                     
                </div>
                <!-- End Description Field  -->
                <!-- Start Ordering Field  -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Ordering</label>
                    <div class="col-sm-10 col-md-6  d-inline-block">
                        <input type="text" name="ordering" class="form-control" placeholder="Number To Arrange The Categories">
                    </div>                     
                </div>
                <!-- End Ordering Field  -->
                <!-- Start Visibility Field  -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Visible</label>
                    <div class="col-sm-10 col-md-6  d-inline-flex">
                        <div class="rad">
                            <input id="vis-yes" type="radio" name="visibility" value="0" checked>
                            <label for="vis-yes"> Yes </label>
                        </div>
                        <div>
                            <input  id="vis-no" type="radio" name="visibility" value="1">
                            <label for="vis-no"> No </label>
                        </div>
                    </div>                     
                </div>
                <!-- End Visibility Field  -->
                <!-- Start Commenting Field  -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Allow Commenting</label>
                    <div class="col-sm-10 col-md-6 d-inline-flex">
                        <div class="rad">
                            <input id="com-yes" type="radio" name="commenting" value="0" checked>
                            <label for="com-yes"> Yes </label>
                        </div>
                        <div>
                            <input  id="com-no" type="radio" name="commenting" value="1">
                            <label for="com-no"> No </label>
                        </div>
                    </div>                     
                </div>
                <!-- End Commenting Field  -->  
                <!-- Start Commenting Field  -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Allow Ads</label>
                    <div class="col-sm-10 col-md-6 d-inline-flex">
                        <div class="rad">
                            <input id="ads-yes" type="radio" name="ads" value="0" checked>
                            <label for="ads-yes"> Yes </label>
                        </div>
                        <div>
                            <input  id="ads-no" type="radio" name="ads" value="1">
                            <label for="ads-no"> No </label>
                        </div>
                    </div>                     
                </div>
                <!-- End Commenting Field  -->                
              
                <!-- Start Submit Field  -->
                <div class="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-10 col-md-6">
                        <input type="submit" value="Add Category" class="btn btn-primary">
                    </div>                     
                </div>
                <!-- End Submit Field  -->
            </form>
        </div> 

        <?php
    }elseif($do == 'Insert') {
            // Insert Categories Page 

 
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                echo  "<h1 class='text-center'>Insert Category</h1>" ;
                echo "<div class='container'>" ;

                // Get Variables From The Form 

                $name       = $_POST['name'] ; 
                $desc       = $_POST['description'] ; 
                $order      = $_POST['ordering'] ; 
                $visible    = $_POST['visibility'] ; 
                $comment    = $_POST['commenting'] ;
                $ads        = $_POST['ads'] ; 
                                


                // Chek If There Is No Error Proceed The Update Operation 


                   // Check If Category Exist In Database 

                   $check = checkItem("Name" , "categories" , $name);
                   
                   if ($check == 1 ) {
                       
                       echo '<div class="container">' ; 

                       $theMsg = '<div class="alert alert-danger"> Sorry This Category Is Exist </div>' ; 

                       redirectHome($theMsg , 'Back') ;

                       echo '</div>' ; 
                   }else {
                      
                       // Insert Catgeroy Info In Database 
                       
                       $stmt = $con->prepare("INSERT INTO
                                           categories(Name , Description , Ordering , Visiblity , Allow_Comment ,Allow_Ads)
                                           VALUES(:zname , :zdesc , :zorder , :zvisible , :zcomment , :zads)");
                       $stmt->execute(array(
                           'zname' => $name , 
                           'zdesc' => $desc , 
                           'zorder'=> $order , 
                           'zvisible' => $visible, 
                           'zcomment' => $comment , 
                           'zads' => $ads 
                       ));  

                       // Echo Success Message  
   
                       $theMsg =  "<div class='alert alert-success'>" .  $stmt->rowCount() . ' Recored Inserted ' ."</div>" ; 

                       redirectHome($theMsg , 'back') ; 
                   }

            }else {
               echo '<div class="container">' ;

               $theMsg  = '<div class="alert alert-danger"> Sorry You Cant Browes This Page Directly </div>' ;

               redirectHome($theMsg , 'back') ;
               
               echo '</div>'; 
           }

            echo '</div>'; 
        

    }elseif($do == 'Edit') {  // Edit Page 

        // Check If Get Request catid Is Numeric  && Get The Integer Value If It 

        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ?  intval($_GET['catid']) : 0 ; 
            
        // Select All Data Depentd On This ID
      
        $stmt = $con->prepare("SELECT *
                           FROM categories 
                           WHERE ID = ?
                           ") ; 
        // Execute Query 
        $stmt->execute(array($catid)) ; 
        // Fetch The Data 
        $cat = $stmt->fetch(); 
        // The Row Count 
        $count = $stmt->rowCount(); 
        // If There IS Such ID Show The Form 
        if($count > 0 ) { ?>
            <h1 class="text-center" > Edit  Categories </h1>
            <div class="container"> 
                <form class="form-horizontal " action="?do=Update" method="POST">
                    <!-- Start Name Field  -->
                    <div class="form-group form-group-lg ">
                        <input type="hidden" name="catid" value="<?php echo $catid ?>">

                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-6  d-inline-block">
                            <input type="text" name="name"  class="form-control" 
                            required="required" placeholder="Name Of The Categories" value="<?php echo $cat['Name'];  ?>">
                        </div>                     
                    </div>
                    <!-- End Name Field  -->
                    <!-- Start Description Field  -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-md-6  d-inline-block">
                            <input type="text" name="description" class="form-control" placeholder="Describe The Category" value="<?php echo $cat['Description'] ;  ?>">
                        </div>                     
                    </div>
                    <!-- End Description Field  -->
                    <!-- Start Ordering Field  -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Ordering</label>
                        <div class="col-sm-10 col-md-6  d-inline-block">
                            <input type="text" name="ordering" class="form-control" placeholder="Number To Arrange The Categories" value="<?php echo $cat['Ordering'] ; ?>">
                        </div>                     
                    </div>
                    <!-- End Ordering Field  -->
                    <!-- Start Visibility Field  -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Visible</label>
                        <div class="col-sm-10 col-md-6  d-inline-flex">
                            <div class="rad">
                                <input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['Visiblity' == 0]) { echo 'checked' ;  } ?> >
                                <label for="vis-yes"> Yes </label>
                            </div>
                            <div>
                                <input  id="vis-no" type="radio" name="visibility" value="1" <?php if($cat['Visiblity'] == 1 ) { echo 'checked' ; } ?> >
                                <label for="vis-no"> No </label>
                            </div>
                        </div>                     
                    </div>
                    <!-- End Visibility Field  -->
                    <!-- Start Commenting Field  -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Commenting</label>
                        <div class="col-sm-10 col-md-6 d-inline-flex">
                            <div class="rad">
                                <input id="com-yes" type="radio" name="commenting" value="0" <?php if($cat['Allow_Comment'] == 0) { echo 'checked' ; }  ?>>
                                <label for="com-yes"> Yes </label>
                            </div>
                            <div>
                                <input  id="com-no" type="radio" name="commenting" value="1" <?php if($cat['Allow_Comment'] == 1) { echo 'checked' ; } ?>>
                                <label for="com-no"> No </label>
                            </div>
                        </div>                     
                    </div>
                    <!-- End Commenting Field  -->  
                    <!-- Start Commenting Field  -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Ads</label>
                        <div class="col-sm-10 col-md-6 d-inline-flex">
                            <div class="rad">
                                <input id="ads-yes" type="radio" name="ads" value="0" <?php if($cat['Allow_Ads'] == 0) { echo 'checked' ; } ?> >
                                <label for="ads-yes"> Yes </label>
                            </div>
                            <div>
                                <input  id="ads-no" type="radio" name="ads" value="1" <?php if($cat['Allow_Ads'] == 1) { echo 'checked'  ; } ?>>
                                <label for="ads-no"> No </label>
                            </div>
                        </div>                     
                    </div>
                    <!-- End Commenting Field  -->                
                
                    <!-- Start Submit Field  -->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10 col-md-6">
                            <input type="submit" value="Save Category" class="btn btn-primary">
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

    }elseif($do == 'Update') {

        echo "<h1 class='text-center'>Update Category</h1>" ;
        echo "<div class='container'>" ; 
 

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Get Variables From The Form 

                $id         = $_POST['catid'] ;
                $name       = $_POST['name'] ; 
                $desc       = $_POST['description'] ; 
                $order      = $_POST['ordering'] ; 
                $visible    = $_POST['visibility'] ; 
                $comment    = $_POST['commenting'] ;
                $ads        = $_POST['ads'] ; 
            

                    // Update The Database With This Info 

                    $stmt = $con->prepare("UPDATE 
                                                categories
                                           SET 
                                                Name = ?,
                                                Description = ?,
                                                Ordering = ?,
                                                Visiblity= ?,
                                                Allow_Comment = ?,
                                                Allow_Ads = ?  
                                           WHERE   
                                                ID = ?");

                    $stmt->execute(array($name , $desc , $order , $visible , $comment , $ads , $id)) ; 

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

    }elseif($do == 'Delete') {   // Delete Member Page

        echo "<h1 class='text-center'>Delete Category</h1>" ;
        echo "<div class='container'>" ; 

            // Check If Get Request userid Is Numeric  && Get The Integer Value If It 

            $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ?  intval($_GET['catid']) : 0 ; 
                
            // Select All Data Depentd On This ID


            $check = checkItem($catid , 'categories' , $catid) ; 

          
            // If There IS Such ID Show The Form 
            if($check > 0 ) {

                $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");

                $stmt->bindParam(":zid" , $catid); // bindParam btrbu6 sha3'lten bb3a9'

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

    }


    include $tpl . 'footer.php' ;

} else {

    header ('Location : index.php ') ;

    exit() ;
}

ob_end_flush() ; // Release The Output 

?>