<?php include ROOT_VIEW . "/template/header.php"; ?>
<?php
$pId = $_GET['id'] ?? null;

$record = null;

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
<!-- Main content -->
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="text-primary">Book Details</h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm rounded">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Book Information</h3>
                            </div>
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="book_id">ID</label>
                                                <input type="hidden" class="form-control" name="book_id" value="<?php echo $record['book_id']; ?>">
                                                <input type="text" class="form-control" value="<?php echo $record['book_id']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" name="title" value="<?php echo $record['title']; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="author">Author</label>
                                                <input type="text" class="form-control" name="author" value="<?php echo $record['author']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="genre">Genre</label>
                                                <input type="text" class="form-control" name="genre" value="<?php echo $record['genre']; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="publication_date">Publication Date</label>
                                                <input type="text" class="form-control" name="publication_date" value="<?php echo $record['publication_date']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="page_count">Page Count</label>
                                                <input type="text" class="form-control" name="page_count" value="<?php echo $record['page_count']; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="publisher">Publisher</label>
                                                <input type="text" class="form-control" name="publisher" value="<?php echo $record['publisher']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="isbn">ISBN</label>
                                                <input type="text" class="form-control" name="isbn" value="<?php echo $record['isbn']; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="original_language_book">Original Language</label>
                                                <input type="text" class="form-control" name="original_language_book" value="<?php echo $record['original_language_book']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bestseller">Bestseller</label>
                                                <select class="form-control" id="estado" name="bestseller" disabled>
                                                    <option value="true" <?php echo (isset($record['bestseller']) && $record['bestseller'] == 'true') ? 'selected' : ''; ?>>True</option>
                                                    <option value="false" <?php echo (isset($record['bestseller']) && $record['bestseller'] == 'false') ? 'selected' : ''; ?>>False</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="book_edition">Edition</label>
                                                <input type="text" class="form-control" name="book_edition" value="<?php echo $record['book_edition']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="translated_book_language">Translated Language</label>
                                                <input type="text" class="form-control" name="translated_book_language" value="<?php echo $record['translated_book_language']; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="legal_deposit_number">Legal Deposit Number</label>
                                        <input type="text" class="form-control" name="legal_deposit_number" value="<?php echo $record['legal_deposit_number']; ?>" disabled>
                                    </div>

                                </div>

                                <div class="card-footer d-flex justify-content-center">
                                    <a class="btn btn-primary" href="<?php echo HTTP_BASE; ?>/web/bok/list">Return</a>
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
