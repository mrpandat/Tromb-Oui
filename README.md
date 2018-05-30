# Tromb-Oui

# Setup

```
docker-compose up
```

## Define Your .env variable
```
touch .env
echo DATABASE_URL=mysql://root:root@mysql:3306/tromboui >> .env
echo KEY_PASSPHRASE=MyPrivatePassphraseHere >> .env
```
## BACKEND

### Create a user with FOSUser
```
docker exec php php bin/console fos:user:create testuser test@example.com p@ssword
```

### Create your database
```
docker exec php bin/console doctrine:database:create
docker exec php bin/console doctrine:schema:update --force
```

### Generate your private keys
```
mkdir -p config/jwt
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```


# API Documentation
|Protocol, Route                |Parameters                          |Description                         |
|----------------|-------------------------------|-----------------------------|
|`POST /api/login_check`|   _username: String, _password: String         |Sign in to get a JWT Token            |
|`GET /api/v1/people/get`|   None         |Get all people            |
|`GET /api/v1/people/get{id}`          |None|Get one people |
|`POST /api/v1/people/new`          |Name: String, Description: String            |Create a new people, JWT required            |
|`POST /api/v1/people/{id}/edit`          |Name: String, Description: String  |Edit a people, JWT required|
|`DELETE /api/v1/people/{id}`          |None|Delete a people, JWT required|
