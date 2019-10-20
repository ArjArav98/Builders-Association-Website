# Setting Up This Project!

### Pre-requisites
* Web Server - Either Nginx or Apache
* MySQL
* PHP 7.2
* Python 3.6

For the first three, you can download either the LEMP or the XAMPP stack to get started.

### Setting Up The Database
* The database schema can be found in ```database/schema.sql```. Copy the contents of the file to your clipboard.
	* In your PHPMyAdmin or in your MySQL server in the command line, execute the following queries.
		```
		CREATE DATABASE BUILDERS_ASSOCIATION;
		USE BUILDERS_ASSOCIATION;
		```
	* Paste the contents of the schema file into the MySQL command prompt and press 'Enter'.
* The database will successfully have been created along with all the tables.

### Creating The Requisite Files
* Create the following files (For Linux/Unix/OS X).

	```
	touch app/admin/history/log.txt
	touch app/admin/history/searched-log.txt
	```

### File/Folder Permissions
* Change the file permission for the following files/folders to 777 (For Linux/Unix/OS X).

	```
	chmod 777 app/admin/history/log.txt
	chmod 777 app/admin/history/searched-log.txt
	chmod 777 app/candidate/register/resumes
	```

### Environment Variables
* For XAMPP/LAMPP, navigate to the ```XAMPP/bin/envvar``` file and paste the following.
	
	```
	BUILDERS_USERNAME="your_sql_username"
	BUILDERS_PASSWORD="your_sql_password"
	BUILDERS_GMAIL_ADDRESS="your_email_account"
	BUILDERS_GMAIL_PASSWORD="your_email_password"
	PYTHON_PATH="path_to_python3.6" #Get this by typing 'type -p python3' in the command line.
	
	export BUILDERS_USERNAME
	export BUILDERS_PASSWORD
	export BUILDERS_GMAIL_ADDRESS
	export BUILDERS_GMAIL_PASSWORD
	export PYTHON_PATH
	```
	
	* Restart the XAMPP/LAMPP server.

* For LEMP, navigate to the ```/etc/environment``` file and paste the following.

	```
	BUILDERS_USERNAME="your_sql_username"
	BUILDERS_PASSWORD="your_sql_password"
	BUILDERS_GMAIL_ADDRESS="your_email_account"
	BUILDERS_GMAIL_PASSWORD="your_email_password"
	PYTHON_PATH="path_to_python3.6" #Get this by typing 'type -p python3' in the command line.
	
	export BUILDERS_USERNAME
	export BUILDERS_PASSWORD
	export BUILDERS_GMAIL_ADDRESS
	export BUILDERS_GMAIL_PASSWORD
	export PYTHON_PATH
	```
	
	* Enter the following command in the command-line.
	
		```source /etc/environment```
