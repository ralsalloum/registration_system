# Symfony 6.0.6 App
## PHP 8.0.15
****************************************************
*. env file and private-public keys not enclosed .*
## Project setup

### First, run following command to install necessary dependencies
```
composer update
```
### Second, creat the database
1) add to** .env** file correct connection string
`DATABASE_URL=mysql://root@127.0.0.1:3306/universityDB?serverVersion=8`

2) create database
```
php bin/console doctrine:database:create
```

3) make migration
```
php bin/console make:migration
```

4) run migration versions to create tables
```
php bin/console doctrine:migration:migrate
```
***

### Thirdly, seed the database using fixtures yaml files
Run the command:
```
php bin/console hautelook:fixtures:load
```

### Routes
#### login
```
Path: /login_check
METHOD: POST
Request: JSON. Fields: username, and password.
```
#### Get all courses for student
```
Path: /v1/courses/courses
METHOD: GET
```
#### Register a student in a new course
```
Path: /v1/courseregistration/register
METHOD: POST
Request: JSON. Fields: courseId.
```