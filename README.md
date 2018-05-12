# Tromb-Oui

# Setup

```
docker-compose up composer
docker-compose up --build
```
# BACKEND

## Create a user with FOSUser
docker exec php php bin/console fos:user:create testuser test@example.com p@ssword

## API
|Protocol + Route                |Parameters                          |Description                         |
|----------------|-------------------------------|-----------------------------|
|`POST /api/login_check`|   _username: String, _password: String         |Sign in to get a JWT Token            |
|`GET /api/v1/people`|   None         |Get all people            |
|`GET /api/v1/people/{id}`          |None|Get one people |
|`POST /api/v1/people/new`          |Name: String, Description: String            |Create a new people            |
|`POST /api/v1/people/{id}/edit`          |Name: String, Description: String  |Edit a people|
|`DELETE /api/v1/people/{id}`          |None|Delete a people|
