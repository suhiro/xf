<html>
<head>
<title>CSV file upload</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
<h1>CSV File upload</h1>
<form method="post" action="/upload" enctype="multipart/form-data">
{{csrf_field()}}
<div class="form-group">
<input type="file" class="form-control" name="csv_file">
</div>
<button type="submit" class="btn btn-primary">Upload</button>

</form>
</div>
</body>
</html>