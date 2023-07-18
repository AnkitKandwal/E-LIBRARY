<?php
include"login-session.php";
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM add_book WHERE id='$id'";
    $data = mysqli_query($con, $query);

    $total = mysqli_num_rows($data);
    $result = mysqli_fetch_assoc($data);
} else {
    echo "No ID specified.";
    exit;
}

if (isset($_POST['submit'])) {

    $bookname = $_POST['bookname'];
    $authorname = $_POST['authorname'];
    $description = $_POST['description'];
    $image = $result['book_img']; 

  
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "images/$image");
    }

   
    $updateQuery = "UPDATE add_book SET book_name='$bookname', author_name='$authorname', description='$description', book_img='$image' WHERE id='$id'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        header("Location: booklisting.php");
        exit;
    } else {
        echo "Failed to update data.";
    }
}
?>

<!--HTML code -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
                        <a href="booklisting.php"><button class="btn ms-5 text-white" style="background-color:green;">Back</button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card mt-2 rounded form-control" style="background-color: rgb(227, 217, 217);">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="Book image col-6 p-4">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="book detail form-group col-6 p-4">
                        <div>
                            <label for=""> Book Name</label><br>
                            <input type="text" value="<?php echo $result['book_name']; ?>" class="form-control mb-3" name="bookname" id="" placeholder="Enter a book name">
                        </div>
                        <div>
                            <label for=""> Author Name</label><br>
                            <input type="text" value="<?php echo $result['author_name']; ?>" class="form-control mb-3" name="authorname" id="" placeholder="Enter an author name">
                        </div>
                        <div>

                            <div>
                                <label for="">Description</label>
                                <textarea class="form-control" id="description" name="description" cols="10" rows="12" required><?php echo $result['description']; ?></textarea>

                                <button class="btn btn-primary mt-1" name="submit">Update</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>