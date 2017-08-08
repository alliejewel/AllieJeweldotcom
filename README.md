Allie Jewel dot com
===================

My personal website and blog.


Installation
------------

Clone the repository:

```bash
git clone https://github.com/alliejewel/AllieJeweldotcom.git
cd AllieJeweldotcom
```

Copy `app/config/parameters.yml.dist` to `app/config/parameters.yml` and then customize it:

```bash
cp app/config/parameters.yml.dist app/config/parameters.yml
vi app/config/parameters.yml
```

Install dependencies using Composer:

```bash
composer install -o
```

Create the database and schema:

```bash
app/console doctrine:database:create
app/console doctrine:schema:create
```

Load fixture data:

```bash
app/console doctrine:fixtures:load --fixtures=vendor/veonik/blog-bundle/src/DataFixtures/ORM --fixtures=/vendor/orkestra/application-bundle/Orkestra/Bundle/ApplicationBundle/DataFixtures/ORM
```


You're all set! Use the default credentials to login:

```
Username: admin
Password: password
```
