# Project LAMP + Moodle 5

# Inside of directory src
- File info.php for test php installation (It`s recommended to delete it)
- File database.php for test database (It`s recommended to delete it)
- File hello.php for test single script php (It`s recommended to delete it)
- Directory moodle for moodle git installation
- Directory moodledata for Moodle

# Remember define enviroment variables file .env with
- MARIADB_DATABASE
- MARIADB_USE
- MARIADB_PASSWORD
- HTTP_PORT

# Remember to define the db directory in the root for the persistence of the database

# For run container
- docker pull superyeahster/lamp-moodle

- docker compose build
- docker compose up

# Install PHPUnit with Composer

- Create directory /var/www/html/moodledataphpunit

- Add to config.php
> // Configuratións for PHPUnit
> $CFG->phpunit_dataroot = '/var/www/html/moodledataphpunit';
> 
> $CFG->phpunit_dbtype    = 'mysqli';      // 'pgsql', 'mariadb', 'mysqli', 'auroramysql', or 'sqlsrv'
> $CFG->phpunit_dblibrary = 'native';     // 'native' only at the moment
> $CFG->phpunit_dbhost    = 'db';  // eg 'localhost' or 'db.isp.com' or IP
> $CFG->phpunit_dbname    = 'dbmoodle';     // database name, eg moodle
> $CFG->phpunit_dbuser    = 'user';   // your database username
> $CFG->phpunit_dbpass    = 'secreto1';   // your database password
> $CFG->phpunit_prefix    = 'phpu_';       // prefix to use for all table names

- In moodle directory: composer require --dev phpunit/phpunit

- Execute inside of moodle directory: php admin\tool\phpunit\cli\init.php
