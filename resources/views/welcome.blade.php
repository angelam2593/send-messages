<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel SMS Send</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light navbar-light">
    <a class="navbar-brand" href="#"><b>Trioptima</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-left: 400px; margin-top:100px;">
            <form method="GET" action="{{ route('email') }}">
                @csrf
                <button type="submit" class="btn btn-info btn-lg" style="width:220px;">Send email</button>
            </form>
            <br>
            <form method="GET" action="{{ route('sms') }}">
                @csrf
                <button type="submit" class="btn btn-info btn-lg" style="width:220px;">Send sms</button>
            </form>
            <br>
            <form method="GET" action="{{ route('listAllSmsMessages') }}">
                @csrf
                <button type="submit" class="btn btn-info btn-lg" style="width:220px;">List SMS messages</button>
            </form>
            <br>
            <form method="GET" action="{{ route('listAllEmailMessages') }}">
                @csrf
                <button type="submit" class="btn btn-info btn-lg" style="width:220px;">List e-mail messages</button>
            </form>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>
                This service provides multiple options:
            <ol>
                <li>
                    <b>Send email -</b> sending email to a recipient with an option for BCC and CC, subject, content and timestamps. You get success or error results according to the status of the email. Sending emails can fail and we log them and save them in the database for further investigation.
                </li>
                <li>
                    <b>Send SMS -</b> sending an SMS to a recipient's mobile phone number, subject, content and timestamps. You get success or error results according to the status of the SMS. Sending SMS can fail and we log them and save them in the database for further investigation. Most usual error is that the phone number is not whitelisted (because we use a free version of Nexmo and we have to whitelist testing numbers).
                </li>
                <li>
                    <b>List email messages -</b> provides filtering all, fetched/successful and unfetched/failed messages. Additionally there's an option for deleting one or multiple emails.
                </li>
                <li>
                    <b>List SMS messages -</b> provides filtering all, fetched/successful and unfetched/failed messages. Additionally there's an option for deleting one or multiple SMS.
                </li>
            </ol>
            </p>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
