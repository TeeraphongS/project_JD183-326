<?php 
    session_start();

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Admin Page</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="admin_home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Information</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="role_type.php">Role Table</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="grade_level.php">Grade Level</a>
      </li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="subject.php">Subject</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="classroom.php">Classroom</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="choose_a_teaching.php">Choose a teaching</a>
      </li>

    </ul>
  </div>
</nav>

    <div class="text-center mt-5">
        <div class="container">

            <?php if(isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <h3>
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>

            <h1>Admin Page</h1>
            <hr>
        
            <h3>
                <?php if(isset($_SESSION['admin_login'])) { ?>
                Welcome, <?php echo $_SESSION['admin_login']; }?>
            </h3>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
            

        </div>
    </div>
    
</body>
</html>