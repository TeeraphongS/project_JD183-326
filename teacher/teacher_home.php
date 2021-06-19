<?php 
  session_start();

  if ($_SESSION['login_type'] != 5) {
      header("location: ../index.php");
  }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<?php include_once('slidebar_teacher.php'); ?>
    <div class="main">

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

            <h1>Teacher Home</h1>
            <hr>
        
            <h3>
                <?php if(isset($_SESSION['user_login'])) { ?>
                Welcome, <?php echo $_SESSION['fname'].' '.$_SESSION['lname'].''.$_SESSION['master_id']; }?>
            </h3>
            

        </div>
    </div>
    </div>
    
    
</body>
</html>