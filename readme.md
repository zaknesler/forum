# Laravel 5.2 Forum

This is a very simple Laravel 5.2 forum that I am working on. I started Laravel about a month ago and I think I've progressed far!

## Update:

> I honestly do not see myself updating this repository in the future. It was an absolute joy to create. Looking through the code it is extremely unorganised and needs improvement. I wish I knew about Authorisation before I made this. If you want to add it, go ahead. Feel free to make any pull requests.

## Installation

First, clone repository to your machine.

Next, install the composer dependencies.
```
composer install
```

After that, visit the `.env` file and make sure that your database and application settings are properly set.

So far you need the following third party services (All offer good enough free services to actively use, if you want to expand, go right ahead):

- [Algolia](https://www.algolia.com/) (search features)
- [Uploadcare](https://uploadcare.com/) (user profile images)
- [Mailgun](https://www.mailgun.com/) (Email management. If you're developing, I'd use [Mailtrap](https://mailtrap.io/) instead)

There is also a configuration file that is located in `config/forum.php`. Feel free to change anything in that file to suit your needs.

Next, run the migrations (Make sure you pass the seed option into this command; it adds the default roles into your database.
```
php artisan migrate --seed
```

*Note: If there are no users in the database, the first user created will have Owner privilages. Any user following the first account will be a regular user.*

**And that's about it. The rest is on the actual website. Enjoy!**

> Just a reminder that this is my first Laravel project so I am probably doing lots of things wrong. If you could correct anything here, please do! I really appreciate feedback and support!
