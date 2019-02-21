# PLEASE READ - DATABASE CONNECTION INSTRUCTIONS
# Update: 2019/02/20: Task 1.1 Complete
# Update: 2019/02/20: Task 1.2 Complete
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
