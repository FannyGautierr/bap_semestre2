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
8. Load the fixtures
```shell
$ php bin/console d:f:l
```

8. Run the server
````shell 
$ symfony serve
````
9. Go to http://localhost:8000

10. Enjoy!

## Trouver les différentes pages et l'admin 

Landing Page Cité Educative : http://127.0.0.1:8000/ <br>
Page Event Cité Educative : http://127.0.0.1:8000/event <br>
Page Event Villeneuve La Garenne : http://127.0.0.1:8000/event2 <br>
Page actualité Villeneuve La Garenne : http://127.0.0.1:8000/actualite <br>
Page d'acceuil Villeneuve La Garenne : http://127.0.0.1:8000/accueil <br>
Formulaire : http://127.0.0.1:8000/survey <br>

Accéder a l'admin : http://127.0.0.1:8000/admin <br>

- Admin : On peut seulement voir les réponses et les statistiques <br>
  Identifiants : <br>
  Mail : a@a.com <br>
  Mot de passe : 123 <br>
- Super Admin : Créer les questionnaires , créer des questions , créer des options et les assigner a des questionnaires <br>
  Identifiants : <br>
  Mail : sa@sa.com <br>
  Mot de passe : 123  <br> 




