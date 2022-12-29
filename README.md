# Packrat Tools website

## Update X00th collections

- Update `$collectionApiId` with Packrat's collection ID
- Export live DB and import into packrat_tools_live locally
- Run `bin/console packrat:recipes`

## Tests

* Run specs: `vendor/bin/phpspec run`

## Anaylse code

* PHPCS: `vendor/bin/phpcs -p --colors`
* PHPMD: `vendor/bin/phpmd src/ text phpmd.xml`
* Fix code: `vendor/bin/php-cs-fixer fix`
* PHP Stan: `vendor/bin/phpstan analyse src tests --level 7`
