# API Routes

### `OPTIONS` [/{routes:.+}](http://localhost/findthewords/{routes:.+})

### `POST` [/register](http://localhost/findthewords/register)
##### security.auth.controller:register
###### register

### `POST` [/login](http://localhost/findthewords/login)
##### security.auth.controller:login
###### login

### `POST` [/auth/refresh](http://localhost/findthewords/auth/refresh)
##### security.auth.controller:refresh
###### jwt.refresh

### `GET` [/users/me](http://localhost/findthewords/users/me)
##### security.auth.controller:me
###### users.me

### `GET` [/](http://localhost/findthewords/)
##### core.controller:root
###### root

### `GET` [/subjects/{id:[0-9]+}](http://localhost/findthewords/subjects/{id:[0-9]+})
##### App\Game\Controller\SubjectController:getSubject
###### get_subject

### `GET` [/subjects](http://localhost/findthewords/subjects)
##### App\Game\Controller\SubjectController:getSubjects
###### get_subjects

### `POST` [/subjects](http://localhost/findthewords/subjects)
##### App\Game\Controller\SubjectController:postSubject
###### post_subject

### `PUT` [/subjects/{id:[0-9]+}](http://localhost/findthewords/subjects/{id:[0-9]+})
##### App\Game\Controller\SubjectController:putSubject
###### put_subject

### `DELETE` [/subjects/{id:[0-9]+}](http://localhost/findthewords/subjects/{id:[0-9]+})
##### App\Game\Controller\SubjectController:deleteSubject
###### delete_subject

### `GET` [/games/{id:[0-9]+}](http://localhost/findthewords/games/{id:[0-9]+})
##### App\Game\Controller\GameController:getGame
###### get_game

### `GET` [/games](http://localhost/findthewords/games)
##### App\Game\Controller\GameController:getGames
###### get_games

### `POST` [/games](http://localhost/findthewords/games)
##### App\Game\Controller\GameController:postGame
###### post_game

### `PUT` [/games/{id:[0-9]+}](http://localhost/findthewords/games/{id:[0-9]+})
##### App\Game\Controller\GameController:putGame
###### put_game

### `DELETE` [/games/{id:[0-9]+}](http://localhost/findthewords/games/{id:[0-9]+})
##### App\Game\Controller\GameController:deleteGame
###### delete_game

### `GET` [/users/{user_id:[0-9]+}/games](http://localhost/findthewords/users/{user_id:[0-9]+}/games)
##### App\Game\Controller\UserGameController:getUserGames
###### get_user_games

### `GET` [/users/{user_id:[0-9]+}/games/{game_id:[0-9]+}](http://localhost/findthewords/users/{user_id:[0-9]+}/games/{game_id:[0-9]+})
##### App\Game\Controller\UserGameController:getUserGame
###### get_user_game

### `GET` [/games/{game_id:[0-9]+}/rounds](http://localhost/findthewords/games/{game_id:[0-9]+}/rounds)
##### App\Game\Controller\GameRoundController:getGameRounds
###### get_game_rounds

### `GET` [/games/{game_id:[0-9]+}/rounds/{round_id:[0-9]+}](http://localhost/findthewords/games/{game_id:[0-9]+}/rounds/{round_id:[0-9]+})
##### App\Game\Controller\GameRoundController:getGameRound
###### get_game_round

### `POST` [/games/{game_id:[0-9]+}/rounds](http://localhost/findthewords/games/{game_id:[0-9]+}/rounds)
##### App\Game\Controller\GameRoundController:postGameRound
###### post_game_round

### `PATCH` [/games/{game_id:[0-9]+}/rounds/{round_id:[0-9]+}](http://localhost/findthewords/games/{game_id:[0-9]+}/rounds/{round_id:[0-9]+})
##### App\Game\Controller\GameRoundController:patchGameRound
###### patch_game_round

