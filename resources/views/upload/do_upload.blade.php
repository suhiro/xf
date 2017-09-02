<html>
<head>
<title>Upload CSV file</title>
</head>
<body>
<h1>Upload CSV file</h1>
<form method="post" action="doUpload" enctype="multipart/form-data">
{{csrf_field()}}
<input type="file" name="work_log">
<input type="submit">



</form>
</body>
</html>