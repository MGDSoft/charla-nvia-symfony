curso_envia
===========

This proyect was created on May 9, 2016, 4:22 pm. for a meeting in NVIA.

Slides: https://slides.com/miguelgarciadominguez/deck/

To start

```sh
git clone https://github.com/MGDSoft/charla-nvia-symfony.git
composer install

# configure your db credentials

php bin/console doctrine:database:create
php bin/console doctrine:schema:create

# To install a external bundle
composer require "lexik/translation-bundle"

```