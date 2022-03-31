# CaseloadPRO Interview

### Description

This coding interview project contains several exercises, each with skeleton code 
that must be filled-in to complete the desired task. Unit tests are provided that 
define the expected output of each method, and are meant to be used as a reference 
during implementation. The objective of this project is to create and/or complete
all required classes and methods for each exercise, such that all unit tests pass.

### Level of Effort

This project should be given a "first pass" level of effort, taking less than an
hour to complete. It is meant to be a showcase for how problems are approached, not
the depth of the solution. Any edge cases or error conditions that are worth
considering, but would take too much time to address, should be mentioned in comments.

### Rules

* For each exercise below, complete the classes/methods to produce the desired output
* All work must be done within the ```interview``` directory
* Do not modify any of the unit tests
* All unit tests should pass

### Coding Exercises

The exercises below are broken down into categories based on the type of processing
being performed. Each file is internally documented to provide a starting point,
but is intentionally left a little vague. Any assumptions made should be commented
in code. Although all unit tests should pass, emphasis is placed on the problem
solving approach and feedback provided within code comments.

* #### Logic
    * **UPC Validator:** The ```interview/Logic``` directory contains a simple
    UPC check sum calculator exercise, and should be the fastest to complete.

* #### File I/O
    * **Fast Animals**: The ```interview/File``` directory contains a class named
    ```Animals```, as well as a data source ```animals.txt```. The class methods
    all expect you to read from the data source, and return useful bits of information.

* #### Abstraction
    * **Warrant Request**: The ```interview/Abstraction``` directory contains several
    files that roughly outline the request/response of a web interface and a basic
    controller. The controller must receive and parse the incoming request and
    return a valid response. The goal is to show an understanding of OOP in PHP, in
    the context of a web service.

### Requirements

* PHP >= 7.0.0
* [Composer](https://getcomposer.org/download/)

### Installation

To get started, make sure you have composer installed, and then run
```composer install``` in the project root to get the required dependencies.

### Running Tests

You can run the tests by executing the ```vendor/phpunit/phpunit/phpunit``` script.
