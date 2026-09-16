<?php
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    do {
        if (empty($name) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }

        //add new data o datbase
        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $successMessage = "Client added correctly";
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css"
</head>

<body>
    <div class="container my-5">
        <h2>New Message</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='button-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row nb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row nb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row nb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row nb-3'>
                <div class='offset-sm-3 col-sm-6'>
            <div class='alert alert-success alert dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='button-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>
            </div>";
            } ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid mb-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid mb-2">
                    <a class="btn btn-outline-primary" href="/portfolio/admin.pdp" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>

</html>