<?php include ROOT_VIEW . "/template/header.php"; ?>
<?php
$pId = $_GET['id'] ?? null;

$record = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'book_id' => $_POST['book_id']
    ];
    $context = stream_context_create([
        'http' => [
            'method' => 'DELETE',
            'header' => "Content-Type: application/json",
            'content' => json_encode($data),
        ]
    ]);
    $url = HTTP_BASE . '/controller/Ven_booksController.php';
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);
    if ($result['ESTADO']) {
        echo "<script>alert('Operation carried out successfully.');</script>";
        echo '<script>window.location.href="' . HTTP_BASE . '/web/bok/list' . '";</script>';
    } else {
        echo "<script>alert('There was a problem, contact the administrator.');</script>";
    }
}

if ($pId) {
    $url = HTTP_BASE . '/controller/Ven_booksController.php?ope=filterId&book_id=' . $pId;
    $response = file_get_contents($url);
    $responseData = json_decode($response, true);
    if ($responseData && $responseData['ESTADO'] == 1 && !empty($responseData['DATA'])) {
        $record = $responseData['DATA'][0];
    } else {
        $record = null;
    }
}
?>

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="text-primary">Delete Book</h5>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-lg">
                            <div class="card-header bg-danger text-white">
                                <h3 class="card-title">Book Details</h3>
                            </div>
                            <form action="" method="post">
                                <div class="card-body bg-light">
                                    <input type="hidden" class="form-control" name="book_id" value="<?php echo $record['book_id']; ?>">
                                    
                                    <div class="form-group">
                                        <label for="book_id">ID</label>
                                        <input type="text" class="form-control" value="<?php echo $record['book_id']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" value="<?php echo $record['title']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Author</label>
                                        <input type="text" class="form-control" value="<?php echo $record['author']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="genre">Genre</label>
                                        <input type="text" class="form-control" value="<?php echo $record['genre']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="publication_date">Publication Date</label>
                                        <input type="text" class="form-control" value="<?php echo $record['publication_date']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="page_count">Page Count</label>
                                        <input type="text" class="form-control" value="<?php echo $record['page_count']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="publisher">Publisher</label>
                                        <input type="text" class="form-control" value="<?php echo $record['publisher']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="isbn">ISBN</label>
                                        <input type="text" class="form-control" value="<?php echo $record['isbn']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="original_language_book">Original Language</label>
                                        <input type="text" class="form-control" value="<?php echo $record['original_language_book']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="bestseller">Bestseller</label>
                                        <select class="form-control" id="estado" name="bestseller" disabled>
                                            <option value="true" <?php echo (isset($record['bestseller']) && $record['bestseller'] == 'true') ? 'selected' : ''; ?>>True</option>
                                            <option value="false" <?php echo (isset($record['bestseller']) && $record['bestseller'] == 'false') ? 'selected' : ''; ?>>False</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="book_edition">Edition</label>
                                        <input type="text" class="form-control" value="<?php echo $record['book_edition']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="translated_book_language">Translated Language</label>
                                        <input type="text" class="form-control" value="<?php echo $record['translated_book_language']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="legal_deposit_number">Legal Deposit Number</label>
                                        <input type="text" class="form-control" value="<?php echo $record['legal_deposit_number']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    <a class="btn btn-secondary" href="<?php echo HTTP_BASE; ?>/web/bok/list">Return</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include ROOT_VIEW . "/template/footer.php"; ?>
