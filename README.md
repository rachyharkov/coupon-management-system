# Coupon Management System

## What is this?

A PHP Web Application build on top of the [CodeIgniter](https://codeigniter.com) which is a PHP full-stack web framework that is light, fast, flexible and secure. This application is currently used by [PT Lapan Technology Indonesia](https://www.lapan-tech.com) as our marketing tool to manage our coupon distribution and redemption. You can use this application as a reference to build your own coupon management system.

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

## Installation & updates

Just clone it, and then run `composer update` whenever there is a new release of app.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

## License

The CodeIgniter framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT) and the application is licensed under the [Apache License 2.0](https://www.apache.org/licenses/LICENSE-2.0).

## Want to make it really yours?

You can change the name of the application, the logo, the favicon, the color scheme, the layout, literally anything. But please don't remove the credits from the footer. I'll be very grateful if you keep the credits there.

If you want to make it really yours and having benefits from it, you check my profile and contact me to discuss about it (because right now my m-banking account is having a problem, so I can't receive any money from you). Oh, also I'll be very happy if you want to contribute to this project.
