<?php
include 'login-session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background: #D071f9;
        }

        table {
            background-color: white;
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    include 'connection.php';
   

    $query = "SELECT * FROM add_book";
    $data  = mysqli_query($con, $query);

    $total = mysqli_num_rows($data);

    if ($total != 0) {
        echo "<h2 class='text-center'>Displaying all records</h2>";
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Book Name</th>
                <th>Author Name</th>
                <th>Description</th>
                <th>Book Image</th>
                <th>Operations</th>
              </tr>";

        while ($result = mysqli_fetch_assoc($data)) {
            echo "<tr>
                    <td>" . $result['id'] . "</td>
                    <td>" . $result['book_name'] . "</td>
                    <td>" . $result['author_name'] . "</td>
                    <td>" . $result['description'] . "</td>
                    <td>" . $result['book_img'] . "</td>
                    <td> <a href='update-design.php?id=$result[id]'>Update</a></td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }

    mysqli_close($con);
    ?>

</body>

</html>
