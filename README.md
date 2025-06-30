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