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
4. Install node dependancies
````shell
$ npm install
````

5. Duplicate the `.env` file and name it `.env.local`
6. Update the `DATABASE_URL` variable in the `.env.local` file with your database credentials.
7. Create the database

````shell
$ php bin/console doctrine:database:create
````
8. Run the migrations
````shell
$ php bin/console doctrine:migrations:migrate
````
9. Run the server
````shell 
$ symfony serve
````
10. Run encore build
````shell 
$ npm run watch
````
11. Go to http://localhost:8000

12. Enjoy!


