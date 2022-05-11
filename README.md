# Cocktails

## Run project locally

```
docker-compose -f docker-compose.dev.yml --env-file .env.local up -d
symfony server:start -d
```

## Launch tests

`symfony php bin/phpunit`