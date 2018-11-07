# Simple SF4 Basket App

**TODO :**

 - [x] Install Bundles
 - [x] Create SQLite DB
 - [x] Create Product Entity (id, name, slug, description, price, image)
 - [x] Create Product Fixtures
 - [ ] Mise en place template BS4 avec nav + content + footer (w Webpack Encore)
 - [ ] Ecran : Product List (order by name, btn product show)
 - [ ] Ecran : Product Show (form add to basket)
 - [ ] Ecran : Basket (List basket item)
 - [ ] Espace Admin : Easyadmin / Sécuriser cet espace d’administration (utilisateur “admin” avec pour mot de passe “password” de type in_memory)
 - [ ] Mise en place API
 - [ ] Commande export CSV
 - [ ] Multilingue
 - [ ] Migrations de base de données
 - [ ] Tests
 - [ ] Readme

##Install

 - clone project from github
 - composer install
 - php bin/console doctrine:database:create
 - php bin/console doctrine:migrations:migrate
 - php bin/console doctrine:fixtures:load