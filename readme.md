### Check 24 task

---
#### Installation
> cp .env.example .env

> docker-compose up -d

> docker-compose exec php composer i

#### Scripts

---

PHPUnit
> docker-compose exec php php vendor/bin/phpunit tests

PHPStan
> docker-compose exec php php vendor/bin/phpstan analyse app tests --level 5

----

#### Test users

>test;test

---

#### TODO LIst

---

- More tests
- Real migrations
- Request validators
- Cache
- Better bootstrap for app
- Support filters and includes in services
- Model factories
- Logging
- Registration page
- Authors page
- Prevent brute force by ip (attempts table)
- Prevent brute force by ip (attempts table)