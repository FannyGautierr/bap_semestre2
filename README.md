# BAP - 2e semester 

## Installation
1. Clone the repository
````shell
$ git clone git@github.com:FannyGautierr/bap_semestre2.git
````
2. Go to the project directory
````shell
$ cd bap_semestre2
````
3. Install composer
````shell
$ composer install
````

4. Duplicate the `.env` file and name it `.env.local`
5. Update the `DATABASE_URL` variable in the `.env.local` file with your database credentials.
6. Create the database

````shell
$ php bin/console doctrine:database:create
````
7. Run the migrations
````shell
$ php bin/console doctrine:migrations:migrate
````
8. Run the server
````shell 
$ symfony serve
````
9. Go to http://localhost:8000

10. Enjoy!


