testing-sandbox
===============

Upcoming library to provide Billing functionality to any PSR compliant project.

Current state:
A practice sandbox on the theme of a billing system. Pushing testing, separation of concerns, and modeling.

**IMPORTANT**: This code is not ready for usage yet.


INSTALLING
==========

1. Get Composer, see: http://getcomposer.org/download/

2. Get the dependencies by using composer

    php composer.phar --dev install

3. Adjust `phpunit.xml` file

    cp phpunit.xml.dist phpunit.xml

3. Execute testing:

    bin/phpunit



SCOPE
=====

The scope of this project is to deliver the following:

*  Provide structure to implement billing system
*  Provide utilities to convert items from an inventory, and create a bill statement based on them
*  Provide mechanism to calculate taxes, and also support compound taxes
*  Provide base entity class for Tax, InventoryItem, Bill, (Bill) Line
*  Provide event based hooks to add your own logic on top of the provided system

