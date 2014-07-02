------------------------------------------------------------------------------------------
1.  Requirements:

Basic HTML and CSS knowledge.

Basic PHP knowledge.

Basic MYSQL knowledge.

Adequate server diskspace to allow for your target audience's volume of job posts.

------------------------------------------------------------------------------------------
2.  Implementation:

i. 	Modify the config.inc.php and db.inc.php to suit your needs.
ii. 	Upload the files to the remote server
iii.	If you are not having the script create your database for you, create the database now
iv.	go to http://your-domain.com/install_folder/setup.php and run the setup script
v.	delete the setup file (or move it out of the web root)
vi.	remove the admin username/password from the config.inc.php file
vii.	go to http://your-domain.com/install_folder/admin.php and log in with your admin username and password
viii.	add some categories and locations and moderators (if you have any people to help you out).
------------------------------------------------------------------------------------------
3.  Items the new user needs to change:

Modify 'badwords.txt' to fit your needs.  The vulgarity filter is based on what
is included in this file.

In each file, functions called 'top' and 'body' are passed string variables for body 
titles.

In order to change the color scheme, the user will need to open the individual 
image files in the 'image' folder (don't be scared, there aren't many!) and change
the colors of each image.

------------------------------------------------------------------------------------------
4.  Database Management and Table Creation:

Database creation can be taken care of by setup.php

If you want the setup to handle this, make sure to configure config.inc.php .  If you don't want the setup to create database
be sure to set $create_database to false

------------------------------------------------------------------------------------------
