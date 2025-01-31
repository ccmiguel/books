<?php include ROOT_VIEW . "/template/header.php"; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
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
            'method' => 'POST',
            'header' => "Content-Type: application/json",
            'content' => json_encode($data),
        ]
    ]);
    $url = HTTP_BASE . '/controller/Ven_booksController.php';
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);
    if ($result["ESTADO"]) {
        echo "<script>alert('Operation carried out successfully.');</script>";
    } else {
        echo "<script>alert('There was a problem, contact the administrator.');</script>";
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
                        <h5 class="text-white">Add New Book</h5>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">    
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card shadow-lg rounded-lg bg-light">
                            <div class="card-header bg-primary text-white text-center">
                                <h3 class="card-title">Book Information</h3>
                            </div>
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title" class="font-weight-bold">Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter book title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="author" class="font-weight-bold">Author</label>
                                        <input type="text" class="form-control" name="author" placeholder="Enter author's name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="genre" class="font-weight-bold">Genre</label>
                                        <input type="text" class="form-control" name="genre" placeholder="Enter genre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="publication_date" class="font-weight-bold">Publication Date</label>
                                        <input type="date" class="form-control" name="publication_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="page_count" class="font-weight-bold">Page Count</label>
                                        <input type="number" class="form-control" name="page_count" placeholder="Enter page count" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="publisher" class="font-weight-bold">Publisher</label>
                                        <input type="text" class="form-control" name="publisher" placeholder="Enter publisher name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="isbn" class="font-weight-bold">ISBN</label>
                                        <input type="text" class="form-control" name="isbn" placeholder="Enter ISBN" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="original_language_book" class="font-weight-bold">Original Language</label>
                                        <input type="text" class="form-control" name="original_language_book" placeholder="Enter original language" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="bestseller" class="font-weight-bold">Bestseller</label>
                                        <select class="form-control" name="bestseller">
                                            <option value="true">True</option>
                                            <option value="false">False</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="book_edition" class="font-weight-bold">Edition</label>
                                        <input type="text" class="form-control" name="book_edition" placeholder="Enter book edition" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="translated_book_language" class="font-weight-bold">Translated Language</label>
                                        <input type="text" class="form-control" name="translated_book_language" placeholder="Enter translated language" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="legal_deposit_number" class="font-weight-bold">Legal Deposit Number</label>
                                        <input type="text" class="form-control" name="legal_deposit_number" placeholder="Enter legal deposit number" required>
                                    </div>
                                </div>

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-success btn-lg">Save</button>
                                    <a class="btn btn-secondary btn-lg" href="<?php echo HTTP_BASE; ?>/web/bok/list">Return</a>
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
