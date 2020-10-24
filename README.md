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
- `./vendor/bin/openapi ./modules/api --output web/openapi.json`
- `./yii serve`
- Go to http://localhost:8080/openapi.json