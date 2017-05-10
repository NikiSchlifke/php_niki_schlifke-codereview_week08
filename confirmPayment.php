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
    <link rel="stylesheet" href="css/main.css">
    <title>Enter your Details</title>
</head>
<body>
<div class="container">
    <div class="my-5">
    <h3>Confirm Payment</h3>
    <h5 class="text-muted">Please enter your Personal details and payment Information.</h5>
    </div>
        <form>

    <div class="row">
        <div class="col-xs-12 col-md-6 form-group">
            <label for="first-name">
                First Name*
            </label>
            <input class="form-control" type="text" name="first-name" id="first-name">
        </div>
        <div class="col-xs-12 col-md-6 form-group">
            <label for="last-name">
                Last Name*
            </label>
            <input class="form-control" type="text" name="last-name" id="last-name">
        </div>
        <div class="col-xs-12 col-md-6 form-group">
            <label for="e-mail">
                E-mail*
            </label>
            <input class="form-control" type="email" name="e-mail" id="e-mail">
        </div>
        <div class="col-xs-12 col-md-6 form-group">
            <label for="address">
                Address
            </label>
            <input class="form-control" type="text" name="address" id="address">
        </div>
        <div class="col-md-12 form-group">
            <label for="card-number">
                Credit Card Number*
            </label>
            <input class="form-control" type="text" name="card-number" id="card-number">
        </div>
        <div class="form-group col-md-3 my-4">
            <label for="pay-now">
                <h5 class="text-muted">Total $ 382.00</h5>
            </label>
            <button class="btn btn-success px-4 form-control" id="pay-now">Pay now</button>

        </div>
    </div>
</form>
</div>
</body>
</html>