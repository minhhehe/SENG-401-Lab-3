# PLEASE READ - DATABASE CONNECTION INSTRUCTIONS
# Update: 2019/02/20: Task 1.1 PDO Complete
# Update: 2019/02/20: Task 1.2 PDO Complete
# Update: 2019/02/21: Task 1.1 + 1.2 MySQL Complete
# Update: 2019/02/21: Task 2 Condition check Complete
# Update: 2019/02/21: Awaiting answer from professor to continue
# Update: 2019/02/21: Task 2 Complete, Styling is... given up
## How to connect to the database
1.  Pull the file `dbConnectorEXAMPLE.php` from the master branch.
2.  Rename `dbConnectorEXAMPLE.php` to `dbConnector.php`
3.  Edit `dbConnector.php` to use your own configuration/credentials

## Notes
A global variable named `$conn` is created inside `dbConnector.php`.
Do **NOT** override `$conn` with a second instance.

Note that `dbConnector.php` has been added to the `.gitignore` file.
This is to ensure you don't accidentally upload your credentials to the main repo.

Remember to configure your database to accept whatever credentials you give in
the `dbConnector.php` file (e.g. ensure user exists, grant necessary permissions)!

Richard Lee  
Feb 16, 2019


## Notes for MySQL Users
If you get the error: "authentication method unknown to the client [caching_sha2_password]":
  - MySQLi is outdated with the authentication method of MySQL so do the following:
    - Go to MySQL Workbench and create a new user by using this SQL: CREATE USER 'name'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
    - OR ALTER USER 'mysqlUsername'@'localhost' IDENTIFIED WITH mysql_native_password BY 'mysqlUsernamePassword';
    - Remember to set the permissions of the new/altered user;
To create a database/schema that works with the developing, do:
  - Workbench SQL: CREATE SCHEMA SENG401
If you get the secure-file-priv error:
  - Locate the directory in Options File -> Security tab -> secure-file-priv and paste the CalgarySchools.csv in there
Import data using Workbench, life is good

### dbConnectorEXAMPLE.php text
    <?php
    /*
        Database connection configuration file
        Remember to rename this file to dbConnector.php
     */
    $host = 'localhost';
    $db = 'SENG401';
    $username = 'my_username';
    $password = 'my_password';

    $dsn = "mysql:host=$host;port=3306;dbname=$db";
    $conn = new PDO($dsn, $username, $password);
    ?>
