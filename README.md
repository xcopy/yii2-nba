## Setup
- `composer install && composer dump`
- `cp .env.dist .env`
- Configure database params in your `.env` file
- `./yii migrate`

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
- Use key `100-token` for `bearerAuth` and `apiKey` methods

## GraphQL
- Go to http://localhost:8080/api/v2

### Simple examples

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