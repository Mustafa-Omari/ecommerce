
 
<nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">OMARI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="container">
        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="dashboard.php"><?php echo lang('HOME_ADMIN') ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="categories.php"><?php echo lang('Categories') ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="items.php"><?php echo lang('ITEMS') ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="members.php"><?php echo lang('MEMBERS') ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="comments.php"><?php echo lang('COMMENTS') ?> <span class="sr-only">(current)</span></a>
            </li>

            <!-- <li class="nav-item ">
                <a class="nav-link" href="#"> <?php // echo lang('STATISTICS') ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#"><?php //  echo lang('LOGS') ?> <span class="sr-only">(current)</span></a>
            </li> -->
            
            
            
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mustafa
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="members.php?do=Edit&userid= <?php echo $_SESSION['ID']  ?>">Edit Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
                
        </div>
    </div>
</nav>




