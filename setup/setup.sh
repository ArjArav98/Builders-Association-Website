# The following are a list of things we need to do for seting up the project.

sudo echo ""
echo "Starting setup process..."

# We first change the permission of a file.
if [ -e ../app/admin/history/log.txt ]
then
	sudo chmod 777 ../app/admin/history/log.txt
	echo "Changed file permissions..."
else
	echo "Creating log file..."
	sudo touch ../app/admin/history/log.txt
	sudo chmod 777 ../app/admin/history/log.txt
	echo "Changed file permissions..."
fi

# We now add some environment variables to the mentioned files.
if [ -e /etc/environment ]
then
	sudo echo "# Environment variables for Builders-Association-Website" >> /etc/environment
	
	read -p "Enter your MySQL Username -> " sql_username
	sudo echo "BUILDERS_USERNAME=\"$sql_username\"" >> /etc/environment

	read -p "Enter your MySQL Password -> " sql_password
	sudo echo "BUILDERS_USERNAME=\"$sql_password\"" >> /etc/environment

	read -p "Enter the E-Mail Address you'd like to use -> " email
	sudo echo "BUILDERS_GMAIL_ADDRESS=\"$email\"" >> /etc/environment

	read -p -s "Enter the password for $email -> " email_password
	sudo echo "BUILDERS_GMAIL_PASSWORD=\"$email_password\"" >> /etc/environment

	python_path=type -p python3
	sudo echo "PYTHON_PATH=\"python_path\"" >> /etc/environment
	
	sudo echo "export BUILDERS_USERNAME" >> /etc/environment
	sudo echo "export BUILDERS_PASSWORD" >> /etc/environment
	sudo echo "export BUILDERS_GMAIL_ADDRESS" >> /etc/environment
	sudo echo "export BUILDERS_GMAIL_PASSWORD" >> /etc/environment
	sudo echo "export PYTHON_PATH" >> /etc/environment

	source /etc/environment

	echo "Added environment variables..."
fi

if [ -e ../../../bin/envvars ]
then
	sudo echo "# Environment variables for Builders-Association-Website" >> ../../../bin/envvars
	
	read -p "Enter your MySQL Username -> " sql_username
	sudo echo "BUILDERS_USERNAME=\"$sql_username\"" >> ../../../bin/envvars

	read -p "Enter your MySQL Password -> " sql_password
	sudo echo "BUILDERS_USERNAME=\"$sql_password\"" >> ../../../bin/envvars

	read -p "Enter the E-Mail Address you'd like to use -> " email
	sudo echo "BUILDERS_GMAIL_ADDRESS=\"$email\"" >> ../../../bin/envvars

	read -p -s "Enter the password for $email -> " email_password
	sudo echo "BUILDERS_GMAIL_PASSWORD=\"$email_password\"" >> ../../../bin/envvars

	python_path=type -p python3
	sudo echo "PYTHON_PATH=\"python_path\"" >> ../../../bin/envvars
	
	sudo echo "export BUILDERS_USERNAME" >> ../../../bin/envvars
	sudo echo "export BUILDERS_PASSWORD" >> ../../../bin/envvars
	sudo echo "export BUILDERS_GMAIL_ADDRESS" >> ../../../bin/envvars
	sudo echo "export BUILDERS_GMAIL_PASSWORD" >> ../../../bin/envvars
	sudo echo "export PYTHON_PATH" >> ../../../bin/envvars

	echo "Added environment variables..."
fi

echo "It's been successfully setup!"
