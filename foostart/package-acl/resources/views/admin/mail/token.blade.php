<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
        {!!  HTML::style('packages/foostart/css/mail-base.css') !!}
        {!! HTML::style('packages/foostart/css/font-awesome-4.7.0.min.css') !!}
	</head>
	<body>
		<h2>Generate token for {!! $body['email'] !!}</h2>
		<div>
            {!! $body['token'] !!}
		</div>
	</body>
</html>
