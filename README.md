testing-sandbox
===============

A practice sandbox on the theme of a billing system. Pushing testing, separation of concerns, and modeling.

IMPORTANT: This code is not ready for usage, unless you want to practice too.

ALSO
====

If you have PHP 5.4 installed, you can run the development server 
by running:

    app/console server:run 127.0.0.1:8080

Open a web browser at: 

    http://127.0.0.1:8080/app.php/


INSTALLING
==========

1. Get Composer, see: http://getcomposer.org/download/

2. Get the dependencies by using composer

    php composer.phar --dev install

3. Execute testing:

    bin/phpunit -c app/phpunit.xml
