## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

 ======== Instruções de Instalação - Primeiros passos IMPORTANTE =========

Apos o git clone do projeto,

-Setar o Virtual Host(Se utilizado) para a pasta public do projeto, em apache/sites-enabled/'nomedosite'.conf

- Executar comando composer install

- Executar comando composer update para adicionar o classloader ao projeto, e demais dependencias

- Se o projeto nao tiver um arquivo .env, gerar um com o comando cp .env.example .env

- Gerar key (comando php artisan key:generate)

- Rodar as migrations de geração de tabelas no Banco de Dados (php artisan migrate)
- Caso de Access Denied, colocar as seguintes configurações no .env:
	DB_HOST=localhost
	DB_DATABASE=NomeDoBanco(Criar um Banco de Dados)
	DB_USERNAME=root
	DB_PASSWORD=''senhaDoBancoSemAspas''

- Popular o Banco de Dados (Com Usuarios para login, por ex) - php artisan db:seed

- Criar Pasta bower_componentes em /resources

- sudo npm install gulp

- bower install

==========================================================================

Configuração de Ambiente e Correcao de BUGS

- ##OPCIONAL Criar um Virtual Host http://laravel-recipes.com/recipes/25/creating-an-apache-virtualhost

- Trabalhar com os arquivos de front-end presentes resources. A aplicacao faz a leitura e execucao em public/build de uma copia gerada apartir de resources.

-Instalação do Node JS - Criação das pastas resources/js/controllers, resources/js/directives, resources/js/filters/services, resources/js/services

- FIX ERROR ENOPCS (gulp watch-dev)

- Para Linux, executar o comando echo fs.inotify.max_user_watches=524288 | sudo tee -a /etc/sysctl.conf && sudo sysctl -p

- Para instalar o angular-oauth2 : bower install angular-oauth2 --save (Se necessario)
- Quanto o angular-oauth2 ja esta instalado, sao criadas 3 pastas em bower_components(angular-oauth2, angular-messages, angular-resource)