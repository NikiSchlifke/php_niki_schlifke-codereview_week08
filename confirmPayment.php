<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
            integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
            integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js" type="application/javascript"></script>
    <link rel="stylesheet" href="css/main.css">
    <title>Enter your Details</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
    <div class="my-5">
    <h3>Confirm Payment</h3>
    <h5 class="text-muted">Please enter your personal details and payment Information.</h5>
    </div>
        <form id="payment-form">

    <div class="row">
        <div class="col-xs-12 col-md-6 form-group">
            <label for="first_name">
                First Name*
            </label>
            <input required class="form-control" type="text" name="first_name" id="first_name">
        </div>
        <div class="col-xs-12 col-md-6 form-group">
            <label for="last_name">
                Last Name*
            </label>
            <input required class="form-control" type="text" name="last_name" id="last_name">
        </div>
        <div class="col-xs-12 col-md-6 form-group">
            <label for="e_mail">
                E-mail*
            </label>
            <input required class="form-control" type="email" name="e_mail" id="e_mail">
        </div>
        <div class="col-xs-12 col-md-6 form-group">
            <label for="address">
                Address*
            </label>
            <input required class="form-control" type="text" name="address" id="address">

        </div>
        <div class="col-md-12 form-group">
            <label for="card_number">
                Credit Card Number*
            </label>
            <input required class="form-control" type="text" name="card_number" id="card_number">

        </div>
        <div class="form-group col-md-3 my-4">
                <h5 class="text-muted">Total <span id="total-price">0.00</span></h5>
            <button type="submit" class="btn btn-success px-4 form-control" id="pay-now">Pay now</button>

        </div>

    </div>
        </form>
    <p class="text-muted">* These fields are required.</p>
        </div>
        <div class="col-md-4 text-center" id="product-cart">
            <?php require_once 'includes/shoppingCartItems.php'?>

        </div>
    </div>
</div>
</body>
<script src="scripts/cart.js" type="application/javascript"></script>
<script src="scripts/product.js" type="application/javascript"></script>
<script src="scripts/payment.js" type="application/javascript"></script>
</html>