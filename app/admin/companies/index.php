<!DOCTYPE html>

	<head>
		<title>Admin - Manage Companies | Builders Association</title>
		<link href="static/css/index.css" rel="stylesheet">
	</head>

	<body>
	
		<!-- This page contains options for adding usernames and password for companies. -->

		<nav>
			<a href="">Manage Companies</a><a
			href="../home/index.php">Candidates List</a><a
			href="../login/index.html">Logout</a>
		</nav>

		<!-- The options for filtering present as a form. -->
		<form method="post" class="manage-company-form">
			<h2>Add Companies</h2>
			<input type="text" name="name" placeholder="Company Name">
			<input type="text" name="username" placeholder="Username">
			<input type="text" name="password" placeholder="Password">
			<button type="submit">Add</button>
		</form>

		<!-- The list of candidates will be displayed here. -->
		<div class="companies-list">

			<div class='company'>
				<p>
					<span class='cell-value alternative-cl'>1011</span>
					<span class='cell-value cell-value-bg-bg'>Sri Venkateswara College of Engineering</span>
					<span class='cell-value cell-value-bg alternative-cl'>svce1</span>
					<span class='cell-value cell-value-bg'>hellosvce1</span>
				</p>
				<form class='company-form'>
					<input type='hidden' value='1011'>
					<button type='submit'>Delete</button>
				</form>
			</div>

			<div class='company'>
				<p>
					<span class='cell-value alternative-cl'>1011</span>
					<span class='cell-value cell-value-bg-bg'>Sri Venkateswara College of Engineering</span>
					<span class='cell-value cell-value-bg alternative-cl'>svce1</span>
					<span class='cell-value cell-value-bg'>hellosvce1</span>
				</p>
				<form class='company-form'>
					<input type='hidden' value='1011'>
					<button type='submit'>Delete</button>
				</form>
			</div>

		</div>

	</body>

</html>
