<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> 
        <title>CRUD</title>
        <link href="">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
            <div class="container">
                <a href="#" class="navbar-brand fw-bold">MY PHP <span class="text-warning">CRUD
                        </span></a>
                <button
                class="button navbar-toggler" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navmenu"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                    
                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link"><span class="text-warning">Home
                        </span></a>
                        </li>
                    </ul>
                </div>
                <ul>
                <?php
                        if(isset($_SESSION["useruid"])){
                            //echo "<li><a href='create.php'>Create Page</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                        }
                        else{
                            echo "<li><a href='signup.php'>Sign up</a></li>";
                            echo "<li><a href='login.php'>Log in</a></li>";
                        }
                    ?>
                    
                </ul>
                </div>
            </div>
        </nav>
        
        <div class="wrapper">

    <section class="index-intro">
    <?php
        if(isset($_SESSION["username"])){
            echo "<p>Hello there ". $_SESSION["username"]." you're now login. </p>";
        }
    ?><br><br>
    <?php 
    $serverName = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "phpcrud";

    $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName); 
    
    if(!$conn){
        die("Connection failed: ".mysqli_connect());
    }
    ?>
    <!--Home-->
    <form method="post">
        <label>Text Field :</label>
        <input id="textboxid" type="text" name="text" placeholder=" Enter Here..">
        <br><br>
        <input type="submit" name="submit" value="Submit">


    </form>
    
    <hr>

    <h3>Publish List</h3>
    <table style="width: 80%" borders="1">
        <tr>
            <th>Newest Post</th>
        </tr>
        <?php
            $i = 1;
            $sql = "select * from publish ";
            $run = $conn -> query($sql);
            if($run -> num_rows > 0){
                while($row = $run -> fetch_assoc()){

        ?>
        
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['usersText'] ?></td>
            <td><?php echo $row['usersDTime'] ?></td>
            <td>
                <a href="./editpublish.php?usersid=<?php echo $row['usersid']; ?>">Update</a>
                <a href="./deletepublish.php?usersid=<?php echo $row['usersid']; ?>" onclick="return 
                    confirm('Are you sure?')">Delete</a>
            </td>

        </tr>
        <?php 
                  }
               }
            ?>
    </table>

    <?php 


if(isset($_POST['submit'])){
    $text = $_POST['text'];

    $sql = "insert into publish values(null, '$text')";
    if(mysqli_query($conn, $sql)){
        echo '<script>alert("Publish successfully.")</script>';
        header('location: create.php');
    }else{
        echo mysqli_error($conn);
    }
}

?>
<?php
    include_once 'footer.php';
?>