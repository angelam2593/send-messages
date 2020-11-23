<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel sending messages</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


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

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
            </li>

        </ul>
    </div>
</nav>
<div class="container">
    <div class="row" style="margin-top:80px;">
        <div class="col-md-12">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle btn-info" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select a filter
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('listAllSmsMessages') }}" id="btnListAllMessages">All
                            messages</a>
                        <a class="dropdown-item" href="{{ route('listFetchedSmsMessages') }}"
                           id="btnListFetchedMessages">Fetched
                            messages</a>
                        <a class="dropdown-item" href="{{ route('listFailedSmsMessages') }}"
                           id="btnListFailedMessages">Failed
                            messages</a>
                    </div>
                </div>
                <br>
                <form method="POST" action="{{ route('deleteSms') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width:220px;">Delete selected messages
                    </button>
                    <br><br>

                    <table class="table">
                        <caption>List of messages</caption>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Recipient</th>
                            <th scope="col">Content</th>
                            <th scope="col">Sent_at</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <th scope="row">{{ $message->id }}</th>
                                <td>{{ $message->recipient_mobile }}</td>
                                <td>{{ $message->content }}</td>
                                <td>{{ $message->sent_at }}</td>
                                <td>{{ $message->error ? 'success' : 'failed' }}</td>
                                <td><input type="checkbox" name="smsToDelete[]"
                                           aria-label="Checkbox for following text input" value="{{ $message->id }}">&nbsp;Delete?
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
                {{ $messages->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script>
</script>
</html>
