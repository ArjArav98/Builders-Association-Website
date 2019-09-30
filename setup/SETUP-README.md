## Setting Up This Project!

### Pre-requisites
* Web Server (Either the XAMPP/LAMPP or the LEMP stack)
* Python3.6

### Setting Up The Database
* For XAMPP, navigate into the PHPMyAdmin tool.
	* Create a database titled 'BUILDERS_ASSOCIATION'.
	* Click on the newly formed database on the left and click 'Import'.
	* Choose the sql schema found in ```database/schema.sql``` and press 'Go'.
	* Done!
* For LEMP, in the command line.
	* Display the contents of the database schema in ```database/schema.sql``` using the ```cat``` command. Copy the contents.
	* Login into the MySQL server in the command line.
	* Create a database titled 'BUILDERS_ASSOCIATION'. Select the database using the ```USE DATABASE``` SQL command.
	* Paste the copied contents and press 'Enter'.
	* Done!
