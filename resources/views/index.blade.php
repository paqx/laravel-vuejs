<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vuejs Feedback Form</title>
		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="bg-light mt-4">
		<div class="container" id="app">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<h1>Vuejs Feedback Form</h1>
					<div class="card">
						<div class="card-body">
							<feedback-form></feedback-form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
	<script src="{{ mix('js/app.js') }}"></script>
</html>
