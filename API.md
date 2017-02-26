# API Routes

### `POST` [/api/register](http://localhost/find-the-words/api/register)
##### AuthController:register
###### register

### `POST` [/api/login](http://localhost/find-the-words/api/login)
##### AuthController:login
###### login

### `POST` [/api/auth/refresh](http://localhost/find-the-words/api/auth/refresh)
##### AuthController:refresh
###### jwt.refresh

### `GET` [/api/users/me](http://localhost/find-the-words/api/users/me)
##### AuthController:me
###### users.me

### `GET` [/api/subjects/{id:[0-9]+}](http://localhost/find-the-words/api/subjects/{id:[0-9]+})
##### App\Controller\SubjectController:getSubject
###### get_subject

### `GET` [/api/subjects](http://localhost/find-the-words/api/subjects)
##### App\Controller\SubjectController:getSubjects
###### get_subjects

### `POST` [/api/subjects](http://localhost/find-the-words/api/subjects)
##### App\Controller\SubjectController:postSubject
###### post_subject

### `PUT` [/api/subjects/{id:[0-9]+}](http://localhost/find-the-words/api/subjects/{id:[0-9]+})
##### App\Controller\SubjectController:putSubject
###### put_subject

### `DELETE` [/api/subjects/{id:[0-9]+}](http://localhost/find-the-words/api/subjects/{id:[0-9]+})
##### App\Controller\SubjectController:deleteSubject
###### delete_subject

### `GET` [/api/games/{id:[0-9]+}](http://localhost/find-the-words/api/games/{id:[0-9]+})
##### App\Controller\GameController:getGame
###### get_game

### `GET` [/api/games](http://localhost/find-the-words/api/games)
##### App\Controller\GameController:getGames
###### get_games

### `POST` [/api/games](http://localhost/find-the-words/api/games)
##### App\Controller\GameController:postGame
###### post_game

### `PUT` [/api/games/{id:[0-9]+}](http://localhost/find-the-words/api/games/{id:[0-9]+})
##### App\Controller\GameController:putGame
###### put_game

### `DELETE` [/api/games/{id:[0-9]+}](http://localhost/find-the-words/api/games/{id:[0-9]+})
##### App\Controller\GameController:deleteGame
###### delete_game

