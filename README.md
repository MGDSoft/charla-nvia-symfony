Nvia Symfony meeting, easy example
==================================

This proyect was created on May 9, 2016, 4:22 pm. for a meeting in NVIA.

Slides: https://slides.com/miguelgarciadominguez/deck/

To start

```sh
git clone https://github.com/MGDSoft/charla-nvia-symfony.git
cd charla-nvia-symfony
composer install

# configure your db credentials

php bin/console doctrine:database:create
php bin/console doctrine:schema:create

# run server

php bin/console server:run

```

Go to url http://127.0.0.1:8000/ App is ready

Playground
==========

Easy install external bundles

```sh
composer require "lexik/translation-bundle"
uncomment files
 - app/AppKernel.php line 20
 - app/config/config.yml line 76-78
 - app/config/routing.yml line 5-7

php bin/console doctrine:schema:update

```

Go to url

http://127.0.0.1:8000/translations/grid
