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

#### Routes

Create article
> POST /articles
 
Example: 
> curl --location --request POST 'http://localhost/articles/' \
--form 'title="test title"' \
--form 'text="test text"' \
--form 'author_id="123"'

---

List of all articles
> GET /articles

Example:
> curl --location --request GET 'http://localhost/articles/'
---

List article by ID
> GET /articles/{id}

Example:
> curl --location --request GET 'http://localhost/articles/1'
---

#### Test users

>test;test

---

#### TODO LIst

---

- More tests
- Migrations
- Request validators
- Cache
- Better bootstrap for app
- ORM
- Model factories
- Logging
- Templates