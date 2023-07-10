<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Listing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container">
            <a class="navbar-brand" href="#">E-library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 mb-lg-0 float-end">
                    <li>
                        <form class="nav-item d-flex" method="GET">
                            <select class="form-control mx-sm-1" style="width: 65px" name="sort" onchange="this.form.submit()">
                                <option value="asc">A-Z</option>
                                <option value="desc">Z-A</option>
                            </select>
                            <input class="form-control" style="margin-right: 2px;" type="search" placeholder="Search" aria-label="Search" name="query">
                            <button class="btn btn-dark btn-sm my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                            <?php if (isset($_GET['query'])) : ?>
                                <a href="booklisting.php" class="btn btn-sm btn-secondary ml-2">Reset</a>
                            <?php endif; ?>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a href="Add-book.php">
                            <button class="btn mx-2 text-white" style="background-color:green;">Add Book</button>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="logout.php?logout=true">
                    <button class="btn text-white" style="background-color:red;">Logout</button>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
    

    <div class="container justify-content-center" style="display: flex;flex-wrap: wrap;">
        <?php
        include 'connection.php';

        $booksPerPage = 10;

        if (isset($_GET['query'])) {
            $searchQuery = $_GET['query'];
            $countQuery = "SELECT COUNT(*) as total FROM add_book WHERE book_name LIKE '%$searchQuery%' OR author_name LIKE '%$searchQuery%'";
            $query = "SELECT * FROM add_book WHERE book_name LIKE '%$searchQuery%' OR author_name LIKE '%$searchQuery%'";
        } else {
            $countQuery = "SELECT COUNT(*) as total FROM add_book";
            $query = "SELECT * FROM add_book";
        }

        $countResult = mysqli_query($con, $countQuery);
        $countRow = mysqli_fetch_assoc($countResult);
        $totalBooks = $countRow['total'];

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $booksPerPage;

        $query .= " LIMIT $offset, $booksPerPage";

        $result = mysqli_query($con, $query);

        if ($result) {
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
            if ($sortOrder === 'desc') {
                usort($rows, function ($a, $b) {
                    return strcmp($b['book_name'], $a['book_name']);
                });
            } else {
                usort($rows, function ($a, $b) {
                    return strcmp($a['book_name'], $b['book_name']);
                });
            }

            foreach ($rows as $row) {
                $bookTitle = $row['book_name'];
                $author = $row['author_name'];
                $image = $row['book_img'];

                $html = '
                <div style="display: flex;flex-wrap: wrap; margin: 20px;">
                    <div class="container mt-5 text-center" style="width: 200px;">
                        <div class="card-group border py-3">
                            <div class="card-body">
                                <img src="images/' . $image . '" class="card-img-top">
                                <h5 class="card-title">' . $bookTitle . '</h5>
                                <h6>' . $author . '</h6>
                                <a href="Read-more-1.php?book_id=' . $row['id'] . '" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>';
                echo $html;
            }
        }

        $totalPages = ceil($totalBooks / $booksPerPage);

       
        echo '<div class="d-flex justify-content-center fixed-bottom py-5">';
        echo '<ul class="pagination">';

        if ($currentPage > 1) {
            $prevPage = $currentPage - 1;
            echo '<li class="page-item">
                    <a class="page-link" href="?page=' . $prevPage . '" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            echo '<li class="page-item">
                    <a class="page-link" href="?page=' . $nextPage . '" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>';
        }

        echo '</ul>';
        echo '</div>';
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>