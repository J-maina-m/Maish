<?php include('config.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Subjects</title>
</head>
<body>
    <?php include('header.php'); ?>
    <h2>Add New Subject</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" required><br>
        <input type="submit" name="add_subject" value="Add Subject">
    </form>

    <?php
    if (isset($_POST['add_subject'])) {
        $name = $_POST['name'];

        $sql = "INSERT INTO subjects (name) VALUES ('$name')";

        if ($conn->query($sql) === TRUE) {
            echo "New subject added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h2>Subject List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM subjects");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>
                    <a href='subject_edit.php?id=".$row['id']."'>Edit</a> |
                    <a href='subject_delete.php?id=".$row['id']."'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php include('footer.php'); ?>
</body>
</html>
