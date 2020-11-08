## Setup
- Create database `yii2_nba`
- `composer install && composer dump`
- `cp .env.dist .env`
- Configure database (`DB_*`) and auth client (`FB_CLIENT_*`) params in your `.env` file
- `./yii migrate`

## Docker
- Install [docker](https://docs.docker.com/engine/install), [docker-compose](https://docs.docker.com/compose/install) (and other related software)
- Change `DB_HOST` to `mysql` or `pgsql` in the `.env` file (https://docs.docker.com/compose/networking)
- `docker-compose down` (stops and removes containers, networks, volumes and images)
- `docker-compose build` ((re)build services)
- `docker-compose up` (builds, (re)creates, starts and attaches to containers for a service)
- Wait until the database is started
- Start new terminal tab and execute commands below in a running container:
    - `docker-compose exec php composer install`
    - `docker-compose exec php ./yii migrate` (all Yii commands should be executed like `docker-compose exec php ./yii <command>`)
- Access to a other containers' console (optional):
    - Nginx `docker-compose exec nginx bash`
    - PostgreSQL `docker-compose exec pgsql bash`
- Go to http://localhost:8000

## Queue
- Configure queue params in your `.env` file (install `redis-server` & `redis-tools`, optional)
- `./yii storage/link`
- `./yii team/fetch-logos` - get team logos
- `./yii team/players` - generate PDF files with players list (optional)
- `./yii queue/run -v` (or `./yii queue/listen -v`)

## OpenAPI
- `./vendor/bin/openapi ./modules/api --output web/`
- `./yii serve`
- Go to http://localhost:8080/api/v1

### Security

- Use login/password `admin`/`admin` for `basicAuth` method
- Use `access_token` column value of `user` table for `bearerAuth` and `apiKey` methods

## GraphQL
- Go to http://localhost:8080/api/v2

### Simple queries

#### Queries

```
{
  players {
    id
    name
  }
}

{
  team(id: 1) {
    name
    players {
      name
    }
  }
}
```

#### Mutations

```
mutation {
  createTeam(name: "Sample Team", division_id: 1) {
    id
    name
  }
}

mutation {
  createTeam(name: "", division_id: 0) {
    name
    _errors {
        name
    }
  }
}

mutation {
  updateTeam(id: 31, name: "Awesome Team") {
    name
  }
}

mutation {
  updateTeam(id: 31, name: "") {
    name
    _errors {
        name
    }
  }
}

mutation {
  deleteTeam(id: 31)
}
```

### Complex queries

#### Variables

```
query ($id: ID!) {
  player(id: $id) {
    id
    name
    team {
      id
      name
    }
  }
}
# Query variables
{
  "id": 1
}
```

#### Directives

```
query ($id: ID!, $withTeam: Boolean!) {
  player(id: $id) {
    id
    name
    team @include(if: $withTeam) {
      id
      name
    }
  }
}

# Query variables
{
  "id": 1,
  "withTeam": true
}
```

#### Fragments

```
query ($id: ID!, $withPlayers: Boolean!) {
  team(id: $id) {
    ...teamFields
  }
}

fragment playerFields on Player {
  id
  name
}

fragment teamFields on Team {
  id
  name
  players @include(if: $withPlayers) {
    ...playerFields
  }
}
# Query variables
{
  "id": 1,
  "withPlayers": true
}
```