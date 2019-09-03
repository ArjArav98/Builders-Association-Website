<!DOCTYPE html>

	<head>
		<title>Admin - Companies List | Builders Association</title>
		<link href="static/css/index1.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>

	<body>
	
		<!-- This page contains options for displaying and searching for candidates. -->
		<!-- This page also contains an option to log out and display comapnies. -->

		<nav>
			<a href="">Companies List</a><a
			href="../home/index.php">Candidates List</a><a
			href="../login/index.html">Logout</a>
		</nav>

		<!-- The options for filtering present as a form. -->
		<form method="get" action="admin-filter.php">
			<h2><i class="material-icons">seach</i> Add Companies</h2>
			<input type="text" name="name" placeholder="Company Name">
			<input type="text" name="username" placeholder="Username">
			<input type="text" name="password" placeholder="Password">
			<button type="submit">Add</button>
		</form>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
		</div>

	</body>

</html>
