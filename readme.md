# Laravel 5.2 Forum

This is a very simple Laravel 5.2 forum that I am working on. It is for personal-use only, so the features and functionality are limited to my own abilities and creativity. (For just starting out with Laravel, I think I am doing pretty well.)

## Demo

I set up a silly little demonstration of this application. Go try it out and let me know what you think. You can do it there! **(:**

[Go to demo website](http://flynk.ml/)

> I left error debugging on, so if something goes wrong, you can tell me what it is.

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
- [Mailgun](https://www.mailgun.com/) (Email management. If you're developing, use [Mailtrap](https://mailtrap.io/) instead)

Next, run the migrations (Make sure you pass the seed option into this command; it adds the default roles into your database.
```
php artisan migrate --seed
```

*Note: If there are no users in the database, the first user created will have Owner privilages. Any user following the first account will be a regular user.*

**And that's about it. The rest is on the actual website. Enjoy!**

> Just a reminder that this is my first Laravel project so I am probably doing lots of things wrong. If you could correct anything here, please do! I really appreciate feedback and support!

## Checklist (no longer updated)

This is the checklist of functionality I wish to have for this project. A strikethrough signifies completion.
- Front-end (Javascript and Stylesheets handled by gulp):
  - ~~Javascript~~
    - ~~jQuery (google hosted)~~
    - ~~Bootstrap~~
    - ~~Uploadcare~~
    - ~~Highlight~~
    - ~~SweetAlert~~
  - ~~Stylesheets~~
    - ~~Bootstrap 3~~
      - ~~Flatly theme~~
        - ~~Customised theme~~
    - ~~Highlight.js~~
    - ~~SweetAlert~~
- Back-end:
  - ~~Base Laravel 5.2 Authentication~~
  - ~~Customised base Laravel 5.2 Authentication~~
  - ~~User profile customisation~~
    - ~~First / Last name~~
    - ~~Location~~
    - ~~Website url~~
    - ~~Biography~~
    - ~~User profile upload~~
      - ~~Uploadcare service~~
      - ~~Gravatar fallback~~
  - ~~User permissions / groups~~
    - ~~Using [entrust](https://github.com/Zizaco/entrust)~~
  - User management
    - ~~User list~~
    - ~~User profile~~
    - ~~Edit user info~~
      - ~~Change user role~~
    - Suspend/Unsuspend users (using soft deletes, most likely)
  - ~~Sections~~
    - ~~View all sections~~
    - ~~Create~~
    - ~~Delete~~
    - ~~Edit~~
    - Locked to specific user groups
    - Topic creation
      - ~~Delete~~
      - ~~Edit~~
      - ~~Report~~
      - ~~Post creation (replying)~~
        - ~~Delete~~
        - ~~Report~~
      - ~~Using Markdown~~
        - ~~With [Laravel Markdown](https://github.com/GrahamCampbell/Laravel-Markdown)~~
