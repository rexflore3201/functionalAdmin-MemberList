<?php
    include_once 'header.php';
?>
    <section class="index-intro">
    <?php
        if(isset($_SESSION["username"])){
            echo "<p>Hello there ". $_SESSION["username"]." you're now login. To continue please click the Profile Page. </p>";
        }
    ?><br><br>
    <?php 
    $serverName = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "phpcrud";

    $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName); 
    
    if(!$conn){
        die('error in conn' . mysqli_error($conn));
    }else{
        $i = 1;
        $userid = $_GET['userid'];
        $sql = "select usersName as usersName, userHome as userHome, usersEmail as usersEmail, usersUid as usersUid from users where userid=$userid ";
                $run = $conn -> query($sql);
                if($run -> num_rows > 0){
                    while($row = $run -> fetch_assoc()){
                        $usersName = $row['usersName'];
                        $userHome = $row['userHome'];
                        $usersEmail = $row['usersEmail'];
                        $usersUid = $row['usersUid'];
                    }
                }
    }
    
    ?>
    <!--Home-->
    <form method="post">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $usersName ?>">
        <br><br>
        <label>Home Address</label>
        <input type="text" name="homead" value="<?php echo $userHome ?>">
        <br><br>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $usersEmail ?>">
        <br><br>
        <label>Username</label>
        <input type="text" name="uid" value="<?php echo $usersUid ?>">
        <br><br>
        <input type="submit" name="update" value="Update">


    </form>
    
    <hr>

    <h3>Member List</h3>
    <table style="width: 80%" borders="1">
        <tr>
            <th>ID No.</th>
            <th>Name</th>
            <th>Home Address</th>
            <th>Email Address</th>
            <th>Username</th>
            <th>Operations</th>
            <th>Status</th>
        </tr>
        <?php
            $i = 1;
            $sql = "select * from users where usersReference='member' ";
            $run = $conn -> query($sql);
            if($run -> num_rows > 0){
                while($row = $run -> fetch_assoc()){

        ?>
        
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['usersName'] ?></td>
            <td><?php echo $row['userHome'] ?></td>
            <td><?php echo $row['usersEmail'] ?></td>
            <td><?php echo $row['usersUid'] ?></td>
            <td>
                <a href="./edit.php?userid=<?php echo $row['userid']; ?>">Edit</a>
                <a href="./delete.php?userid=<?php echo $row['userid']; ?>" onclick="return 
                    confirm('Are you sure?')">Delete</a>
            </td>
            <?php
            $status=$row['status'];
            if($status==0) $strStatus="<a href=useractive.php?userid=".$row['userid'].">Activate User</a>";
            if($status==1) $strStatus="<a href=userdeactive.php?userid=".$row['userid'].">Deactivate User</a>";
            echo "<br><td>".$strStatus."</td>";
            ?>
        </tr>
        <?php 
                  }
               }
            ?>
    </table>

    <?php 

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $homead = $_POST['homead'];
    $email = $_POST['email'];
    $uid = $_POST['uid'];

    $sql = "update users set usersName='$name', userHome='$homead', usersEmail='$email',
        usersUid='$uid' where userid = $userid";
    if(mysqli_query($conn, $sql)){
        echo '<script>alert("User registered successfully.")</script>';
        //header('location: index.php');
    }else{
        echo mysqli_error($conn);
    }
}

?>
<?php
    include_once 'footer.php';
?>


