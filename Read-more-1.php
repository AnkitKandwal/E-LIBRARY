<?php
// Retrieve the data from the query parameters
include 'connection.php';


$newid = $_GET['book_id'];
$query = "SELECT * FROM add_book where id = '$newid'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read More</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 mb-lg-0 float-end">
                    <li class="nav-item ">
                        <!-- Button on the right side -->
                        <a href="booklisting.php">
                            <button class="btn ms-5 text-white" style="background-color:green;">Back</button>
                        </a>
                    </li>
                    <a href="delete.php?id= $row['id'];" class="btn ms-4 text-white" style="background-color: red;">Delete Book</a>
                    <li>
                       
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Read More -->

    <?php
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bookimage = $row['book_img'];
        $id = $row['id'];
        $bookname = $row['book_name'];
        $authorname = $row['author_name'];
        $description = $row['description'];

        // Display the data on the second page
        echo '
<div style="display: flex; flex-wrap: wrap; margin: 20px;">
    <div class="container mt-2">
        <div class="card rounded-0" style="background-color: #D0CACA;">
            <div class="d-flex">
                <div class="">
                    <img src="' . $bookimage . '" class="rounded-0" style="width: 400px;">
                </div>

                <div class="p-2 py-3">
                    <label for="">Book name</label>
                    <h5>' . $bookname.'</h5>
                    <hr>
                    <label for="">Author name</label>
                    <h5>' . $authorname . '</h5>
                    <hr>
                    <label for="">Description</label>
                    <h5>' . $description . '</h5>
                </div>
            </div>
        </div>
    </div>
</div>';
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>