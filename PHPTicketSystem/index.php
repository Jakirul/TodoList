<?php 
    $errors = "";
    $connection = mysqli_connect("localhost","root","","todolistphp");

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if (empty($task)) {
            $errors = "ERROR: You must fill in the task";
        }
        else {
            mysqli_query($connection,"INSERT INTO todolistphp (task) VALUES ('$task')");
            header('location: index.php');
        }
    }

    if (isset($_POST['delete_all'])) {
            mysqli_query($connection,"DELETE FROM todolistphp");
            header('location: index.php');
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        mysqli_query($connection,"DELETE FROM todolistphp WHERE id=$id");
        header('location: index.php');
    }

    $tasks = mysqli_query($connection,"SELECT * from todolistphp");
?>

<!DOCTYPE html>
<html>
    <head>
        <div class="main" style="overflow:scroll">
        <title>Todo List PHP</title>
        <link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&family=Rubik&display=swap" rel="stylesheet"> 
    </head>
    <body>
        <h1>Todo List in PHP</h1>
        <form method="POST" action="index.php" >
            <?php if(isset($errors)) { ?>
                <p><?php echo $errors; ?></p>
            <?php }?>
            <input type="text" name="task" class="task_input">
            <button type="submit" class="add_button" name="submit">Add Task</button>
            <button type="submit" class="delete_button" name="delete_all">Delete ALL Tasks</button>
        </form>

        <table>
            <tbody><?php
            if(mysqli_num_rows($tasks) > 0) { ?>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task Information</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <?php
                 $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class="task"><?php echo $row['task']; ?></td>
                        <td class="delete">
                            <a href="index.php?delete=<?php echo $row['id']; ?>"><img src="images/x.png"></a>
                        </td>
                    </tr>
                <?php $i++; }}
                else {
                    echo "No record found";
                } ?>
                
            </tbody>
        </table>
        </div>
        <footer>
            <p>Jakirul Islam </p>
            <img src="images/github.png" width="30px" height="30px"onclick=" window.open('https://github.com/Jakirul/','_blank')">
            <img src="images/email.png" width="30px" height="30px"  onclick=" window.open('mailto:jakirul.islam@live.co.uk','_blank')">
            <img src="images/linkedin.png" id="footer3" width="30px" height="30px" margin="50px" onclick=" window.open('https://www.linkedin.com/in/jakirul/','_blank')">
        </footer>   
    </body>
</html>