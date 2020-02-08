<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Invitation</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div class="content">
        <div class="row">
            <p>Hi {{ $invitation->name }},</p>

            <p>You have been invited for TODO app. Click link below to confirm</p>
            <p><a href="{{ route('invitations.show', ['token' => $invitation->token]) }}">{{ route('invitations.show', ['token' => $invitation->token]) }}</a></p>
        </div>
    </div>
</body>
</html>
