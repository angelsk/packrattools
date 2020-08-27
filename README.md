# Packrat Tools website

## Tests

* Run specs: `vendor/bin/phpspec run`

## Anaylse code

* PHPCS: `vendor/bin/phpcs -p --colors`
* PHPMD: `vendor/bin/phpmd src/ text phpmd.xml`
* Fix code: `vendor/bin/php-cs-fixer fix`
* PHP Stan: `vendor/bin/phpstan analyse src tests --level 7`

## Dev'ing

`composer install` to install PHP dependencies  
`symfony serve` to start server  
`yarn` to install yarn dependencies  
`yarn run dev` build encore dev build  
`yarn watch` to keep rebuilding assets  
