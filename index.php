<html>
	<head>
		<title>Danbooru Downloader</title>
		<link rel="stylesheet" href="style.css">
		<meta charset="utf-8">
	</head>

	<body>
		<h1>Danbooru Downloader</h1>
		<h3>by hecanymous</h3>
		
		<p>
			Fill out the simple form below to get your images! There are some
			circumventions I had to take for this app to work, so I will
			only allow 2 tags even though it will (and does) <i>technically</i> work with
			more than that, but that's the under the hood stuff you don't need to worry about.
		</p>
		
		<form action="search.php?page=1" method="GET">
			Main tag: <br><input type="text" name="tag1" required><br>
			Additional tag (optional): <br><input type="text" name="tag2"><br>
			<input type="submit" value="Search"><br>
		</form>		
	</body>
</html>