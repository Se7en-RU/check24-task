### Check 24 task

---
#### Installation
> cp .env.example .env

> docker-compose up -d

> docker-compose exec php composer i

Open
http://localhost:80

#### Test users

>test;test

---
#### Scripts

---

PHPUnit
> docker-compose exec php php vendor/bin/phpunit tests

PHPStan
> docker-compose exec php php vendor/bin/phpstan analyse app tests --level 5

----

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
- Article comments
- Author name and comments count in article
- Prevent brute force by ip (attempts table)
