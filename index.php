<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Listing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">
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
                        <a href="Add-book.php">
                            <button class="btn mx-1 text-white" style="background-color:green;">Add Book</button>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <div style="display: flex;flex-wrap: wrap; margin: 20px;">
        <div class="container mt-5 text-center" style="width: 220px;">
            <div class="card">
                <div class="card-body">
                    <img src="Spare.webp" class="card-img-top" alt="Book Image" style="width: 100px;">
                    <h5 class="card-title">Spare</h5>
                    <h6>Prince Harry</h6>

                    <a href="Read-more.php" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>