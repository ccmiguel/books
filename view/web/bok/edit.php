<?php include ROOT_VIEW . "/template/header.php"; ?>

<?php
$pId = $_GET['id'] ?? null;
$record = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'book_id' => $_POST['book_id'],
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'genre' => $_POST['genre'],
        'publication_date' => $_POST['publication_date'],
        'page_count' => $_POST['page_count'],
        'publisher' => $_POST['publisher'],
        'isbn' => $_POST['isbn'],
        'original_language_book' => $_POST['original_language_book'],
        'bestseller' => $_POST['bestseller'],
        'book_edition' => $_POST['book_edition'],
        'translated_book_language' => $_POST['translated_book_language'],
        'legal_deposit_number' => $_POST['legal_deposit_number']
    ];

    $context = stream_context_create([
        'http' => [
            'method' => 'PUT',
            'header' => "Content-Type: application/json",
            'content'=> json_encode($data),
        ]
    ]);

    $url = HTTP_BASE .'/controller/Ven_booksController.php';
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);

    if ($result["ESTADO"]) {
        echo "<script>alert('Operation carried out successfully.');</script>";
    } else {
        echo "<script>alert('There was a problem, contact the administrator.');</script>";
    }
}

if ($pId) {
    $url = HTTP_BASE . '/controller/Ven_booksController.php?ope=filterId&book_id='. $pId;
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
                        <h5 class="text-primary">Modify Book</h5>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h3 class="card-title">Edit Book</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="book_id">ID</label>
                                        <input type="hidden" class="form-control" name="book_id" value="<?php echo $record['book_id']; ?>">
                                        <input type="text" class="form-control" value="<?php echo $record['book_id']; ?>" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php echo $record['title']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="author">Author</label>
                                        <input type="text" class="form-control" name="author" value="<?php echo $record['author']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="genre">Genre</label>
                                        <input type="text" class="form-control" name="genre" value="<?php echo $record['genre']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="publication_date">Publication Date</label>
                                        <input type="text" class="form-control" name="publication_date" value="<?php echo $record['publication_date']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="page_count">Page Count</label>
                                        <input type="text" class="form-control" name="page_count" value="<?php echo $record['page_count']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="publisher">Publisher</label>
                                        <input type="text" class="form-control" name="publisher" value="<?php echo $record['publisher']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="isbn">ISBN</label>
                                        <input type="text" class="form-control" name="isbn" value="<?php echo $record['isbn']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="original_language_book">Original Language</label>
                                        <input type="text" class="form-control" name="original_language_book" value="<?php echo $record['original_language_book']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="bestseller">Bestseller</label>
                                        <select class="form-control" name="bestseller">
                                            <option value="true" <?php echo ($record['bestseller'] == 'true') ? 'selected' : ''; ?>>True</option>
                                            <option value="false" <?php echo ($record['bestseller'] == 'false') ? 'selected' : ''; ?>>False</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="book_edition">Edition</label>
                                        <input type="text" class="form-control" name="book_edition" value="<?php echo $record['book_edition']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="translated_book_language">Translated Language</label>
                                        <input type="text" class="form-control" name="translated_book_language" value="<?php echo $record['translated_book_language']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="legal_deposit_number">Legal Deposit Number</label>
                                        <input type="text" class="form-control" name="legal_deposit_number" value="<?php echo $record['legal_deposit_number']; ?>">
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                        <a class="btn btn-secondary" href="<?php echo HTTP_BASE; ?>/web/bok/list">Return</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include ROOT_VIEW . "/template/footer.php"; ?>
