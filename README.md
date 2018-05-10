# Tromb-Oui

# Setup

```
docker-compose up composer
docker-compose up --build
```
# BACKEND

## API
|Protocol + Route                |Parameters                          |Description                         |
|----------------|-------------------------------|-----------------------------|
|`GET /api/v1/people`|   None         |Get all people            |
|`GET /api/v1/people/{id}`          |None|Get one people |
|`POST /api/v1/people/new`          |Name: String, Description: String            |Create a new people            |
|`POST /api/v1/people/{id}/edit`          |Name: String, Description: String  |Edit a people|
|`DELETE /api/v1/people/{id}`          |None|Delete a people|
