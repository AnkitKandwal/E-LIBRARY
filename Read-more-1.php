<?php
include 'connection.php';
include 'login-session.php';
$newid = $_GET['book_id'];
$query = "SELECT * FROM add_book where id = '$newid'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $bookimage = $row['book_img'];
    $id = $row['id'];
    $bookname = $row['book_name'];
    $authorname = $row['author_name'];
    $description = $row['description'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read More</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            background-color: #D0CACA;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 mb-lg-0 float-end">
              
                <?php if($_SESSION['user_type'] == 'admin'){ ?>
               <li class="nav-item">
                        <a href="Edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                    </li>
                    <li>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn ms-2 text-white" style="background-color: red;">Delete</a>
                    </li>
               <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-2">
        <div class="card rounded-0">
            <div class="d-flex flex-wrap">
                <div class="col-12 col-md-6">
                    <img src="images/<?php echo $bookimage; ?>" class="rounded-0" alt="Book Image">
                </div>
                <div class="col-12 col-md-6 p-2 py-3">
                    <label for="">Book name</label>
                    <h5><?php echo $bookname . ' ' . $id; ?></h5>
                    <hr>
                    <label for="">Author name</label>
                    <h5><?php echo $authorname; ?></h5>
                    <hr>
                    <label for="">Description</label>
                    <h5><?php echo $description; ?></h5>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
}
?>
