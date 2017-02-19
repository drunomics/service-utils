# Service Utils
[![Build Status](https://api.travis-ci.org/drunomics/service-utils.svg?branch=2.x)](https://travis-ci.org/drunomics/service-utils)
(c) 2017 drunomics GmbH

Provides setter injection traits in order to ease dependency injection of
services.

## Versions

Major version numbers match Drupal 8 core compatibility, e.g.

     2.x -> Drupal 8.2.x
     3.x -> Drupal 8.3.x
 
## Scope

This covers traits for services that are missing from core or contrib modules.

## Usage

 - Install the package via `composer require drunomics/service-utils`

 - Just "use" the trait for the service you want to use. The trait provides a 
   suiting getter; e.g., `getEntityTypeManager()`.
 
## Adding a missing trait

 - Just add new trait and add it in the respective namespace. The namespace
   should match the namespace of the service, but start with
   \drunomics\ServiceUtils instead of \Drupal.
 - Every trait needs a respective test case. You can simply copy an existing
   test case and adapt it as necessary.
 - Run tests to ensure everything works as needed and file a PR for your !
 - If your trait covers a contrib module, make sure the contrib module is added
   as dev-dependency, so its classes are there for running tests.
   
## Running tests
 - Just clone the project and run the following commands from the project
   directory:
```
   composer install
   ./vendor/bin/phpunit # or use the shortcut
   composer test
```

## Coding style

To check the coding style for the project's custom code, run PHP code sniffer:
    
    composer cs
    
To automatically fix the coding style errors (as far as possible), run the PHP
code beautifier:

    composer cbf

## FAQ

 - Why are the traits not added to the upstream source (core or contrib modules)
   instead?
   
   This would be the best option, but results in a worse developer experience
   (DX) while patches are not committed. The goal of this package is to make
   dependency injection almost as quick as calling out to \Drupal::container(),
   thus adding in a patch every time a dependency is needed is taking too long
   and so results in a worse DX.

   The suggested workflow is to quickly add missing traits to this package, so
   they are immediately available for everyone's use. On a regular basis,
   patches for traits should be filed against upstream projects in order to
   improve them and deprecate this package in the long term. Once those patches
   landed in new upstream releases, the service-utils usages could be replaced
   and the package can be safely dropped from a project.
   
 - Why are there no stable releases?
 
   Because every commit can be considered a new stable version. It's generally
   fine to always get the latest version, as every trait works independent on
   its own and won't be touched again once added.
   Given this library contains only simple, tested traits it's simple to avoid
   any backward incompatible changes. This is verified by the following:
   
    - The package version constraints make sure the version matching the right
      core version is installed.
    - We won't remove or change any existing traits once added.

 - Why is this no project on drupal.org?
 
   Because drupal.org has no project type for composer packages and using Github
   with Travis for tests is convenient.
