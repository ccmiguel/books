<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management</title>
    <!-- AdminLTE and Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/css/estilo3.css">
    <style>
        /* Custom Styles */
        body {
            background-color: #f4f6f9;
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .card-header h3 {
            font-size: 1.2rem;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        .btn-danger {
            background-color: #e74a3b;
            border-color: #e74a3b;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .table {
            border-color: #dee2e6;
        }

        .table thead {
            background-color: #f8f9fa;
            color: #495057;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .pagination .page-link {
            color: #007bff;
        }

        .pagination .page-link:hover {
            background-color: #e9ecef;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>

<?php require(ROOT_VIEW.'/template/header.php')?>
<?php
    $page = 1;
    $ope = 'filterSearch';
    $filter = '';
    $items_per_page = 10;
    $total_pages = 1;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $filter = urlencode(trim(isset($_POST['filter']) ? $_POST['filter'] : ''));
    }
    $url = HTTP_BASE . "/controller/Ven_booksController.php?ope=" . $ope . "&page=" . $page . "&busqueda=" . $filter;
    $filter = urldecode($filter);
    $response = file_get_contents($url);
    $responseData = json_decode($response, true);
    $records = $responseData['DATA'];
    $totalItems = $responseData['LENGTH'];
    try {
        $total_pages = ceil($totalItems / $items_per_page);
    } catch (Exception $e) {
        $total_pages = 1;
    }

    // Pagination logic
    $max_links = 5;
    $half_max_link = floor($max_links/2);
    $start_page = $page - $half_max_link;
    $end_page = $page + $half_max_link;
    if($start_page<1)
    {
        $end_page += abs($start_page)+1;
        $start_page = 1;
    }
    if($end_page> $total_pages)
    {
        $start_page -= ($end_page-$total_pages);
        $end_page = $total_pages;
        if($start_page<1)
        {
            $start_page = 1;
        }
    }
?>

<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-info">Book Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Books</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-outline card-info">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Manage Your Book Collection</h3>
                        <form action="" method="POST" class="d-flex">
                            <input type="text" name="filter" class="form-control form-control-sm" placeholder="Search by title or author" value="<?php echo $filter;?>">
                            <button type="submit" class="btn btn-info btn-sm ml-2">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="<?php echo HTTP_BASE . '/web/bok/create'; ?>" class="btn btn-info btn-sm mr-2">
                                <i class="fas fa-plus"></i> Add New Book
                            </a>
                            <a href="<?php echo HTTP_BASE . '/reports/rpt_pdf_total_books.php?filter=' . urlencode($filter); ?>" class="btn btn-danger btn-sm mr-2" target="_blank">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                            <a href="<?php echo HTTP_BASE . '/reports/rpt_excel_total_books.php?filter=' . urlencode($filter); ?>" class="btn btn-success btn-sm" target="_blank">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Genre</th>
                                        <th>Publication</th>
                                        <th>Page Count</th>
                                        <th>Publisher</th>
                                        <th>ISBN</th>
                                        <th>Language</th>
                                        <th>Bestseller</th>
                                        <th>Edition</th>
                                        <th>Translated</th>
                                        <th>Legal Deposit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($records as $row) : ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo HTTP_BASE . '/web/bok/view/' . $row['book_id']; ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?php echo HTTP_BASE . '/web/bok/edit/' . $row['book_id']; ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?php echo HTTP_BASE . '/web/bok/delete/' . $row['book_id']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                                            <td><?php echo htmlspecialchars($row['author']); ?></td>
                                            <td><?php echo htmlspecialchars($row['genre']); ?></td>
                                            <td><?php echo htmlspecialchars($row['publication_date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['page_count']); ?></td>
                                            <td><?php echo htmlspecialchars($row['publisher']); ?></td>
                                            <td><?php echo htmlspecialchars($row['isbn']); ?></td>
                                            <td><?php echo htmlspecialchars($row['original_language_book']); ?></td>
                                            <td><?php echo htmlspecialchars($row['bestseller']); ?></td>
                                            <td><?php echo htmlspecialchars($row['book_edition']); ?></td>
                                            <td><?php echo htmlspecialchars($row['translated_book_language']); ?></td>
                                            <td><?php echo htmlspecialchars($row['legal_deposit_number']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer card-info">
                        <ul class="pagination pagination-sm justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <form action="" method="POST">
                                        <input type="hidden" name="page" value="1">
                                        <button type="submit" class="page-link">First</button>
                                    </form>
                                </li>
                                <li class="page-item">
                                    <form action="" method="POST">
                                        <input type="hidden" name="page" value="<?php echo ($page - 1); ?>">
                                        <button type="submit" class="page-link">&laquo;</button>
                                    </form>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = $start_page; $i <= $end_page; $i++) : ?>
                                <li class="page-item <?php echo ($page == $i ? 'active' : ''); ?>">
                                    <form action="" method="POST">
                                        <input type="hidden" name="page" value="<?php echo $i; ?>">
                                        <button type="submit" class="page-link"><?php echo $i; ?></button>
                                    </form>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <form action="" method="POST">
                                        <input type="hidden" name="page" value="<?php echo ($page + 1); ?>">
                                        <button type="submit" class="page-link">&raquo;</button>
                                    </form>
                                </li>
                                <li class="page-item">
                                    <form action="" method="POST">
                                        <input type="hidden" name="page" value="<?php echo $total_pages; ?>">
                                        <button type="submit" class="page-link">Last</button>
                                    </form>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php require(ROOT_VIEW.'/template/footer.php')?>

</body>
</html>
