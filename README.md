
## Requirements

The following tools are required in order to start the installation.

- PHP >=7.3
- [Composer](https://getcomposer.org/download/)
- [NPM](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

## Installation

> Note that your database setup needs to be configured in your .env file
> Note to test the scheduler set, kindly create new terminal, navigate to this application root, then run php artisan schedule:work

1. Clone this repository with `git clone git@github.com:aoa-designs/square1_test.git`
2. Run `composer install` to install the PHP dependencies
3. Set up a local database called `laravel`
4. Run `composer setup` to setup the application
7. Configure the (optional) features from below

You can now visit the app in your browser by visiting [http://http://127.0.0.1:8000](http://127.0.0.1:8000).

## Commands

Command | Description
--- | ---
**`php artisan test `** | Run the tests
**`php artisan schedule:work `** | Run the scheduler
`php artisan migrate:fresh --seed` | Reset the database
`npm run watch` | Watch for changes in CSS and JS files

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## License

The MIT License. Please see [the license file](LICENSE.md) for more information.

