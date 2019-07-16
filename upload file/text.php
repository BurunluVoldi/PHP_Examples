<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Upload something, download anything</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="upload.php" method="post" enctype="multipart/form-data" name="uploadable">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Surname:</label>
                            <input type="text" class="form-control" name="surname">
                        </div>
                        <div class="form-group">
                            <label for="name">Insert a file:</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control" name="submit">Upload!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>