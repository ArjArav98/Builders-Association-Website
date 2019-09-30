# Setting Up This Project!

### Pre-requisites
* Web Server (Either the XAMPP/LAMPP or the LEMP stack)
* Python3.6

### Setting Up The Database
* The database schema can be found in ```database/schema.sql```. Import this using PHPMyAdmin or MySQL in the command line.

### File Permissions
* Change the file permission for ```app/admin/history/log.txt``` to 777.

	```chmod 777 app/admin/history/log.txt```

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
