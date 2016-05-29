# Laravel 5.2 Forum

This is a very simple Laravel 5.2 forum that I am working on. It is for personal-use only, so the features and functionality are limited to my own abilities and creativity. (For just starting out with Laravel, I think I am doing pretty well.)

## Installation
If you want to download and use this for yourself, you may. You may add or change whatever you'd like, but I would like some credit.

Now let's get this record straight. I am sure that there is a better way for users to download and use this, but as of now just clone this repository to your machine.

Then, make sure you install the composer dependencies.
```
composer install
```

Also, visit the `.env` file and make sure that your database and application settings are properly set.

Next, run the migration to get the tables.
```
php artisan migrate
```

In order for the roles to work, we'll install the default roles.
```
php artisan migrate --seed
```

*Note: If there are no users in the database, the first user created will have Owner privilages. Any user following the first account will be a regular user.*

**And that's about it. The rest is on the actual website. Enjoy!**

-- Just a reminder that this is my first Laravel project so I am probably doing lots of things wrong. If you could correct anything here, please do! I really appreciate feedback and support!

## Checklist

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
