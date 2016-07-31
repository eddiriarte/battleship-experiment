PHP Battleship
==============

by ```eddiriarte```

The ```PHP Battleship``` project is a basic experiment with PHP and allows to play battleship against the computer....
The application has been kept as simple as possible and was implemented in an object-oriented way that easelly allows to extend the game with new features.

## Requirements

- PHP 5.4.+
- Composer
- Running Apache-Server [optional]

## Installation

1. Clone this repository
    ```
    git clone git@github.com:eddiriarte/php-battleship.git
    ```
2. Install dependencies
    ```
    composer install
    ```
3. If using apache copy files to root directory. Go to 5.
4. Open console and change to project directory. Then run:
    ```
    php -S localhost:4400 -t .
    ``` 
5. Open Application with your browser (e.g ```http://localhost:4400```)

## License

The MIT License (MIT)

Copyright (c) 2016 eddiriarte

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
