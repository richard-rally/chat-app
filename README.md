# Chat app

Built using PHP, Laravel, MySQL, websockets and Vue.js.

It uses Laravel Sail as an environment so should be straight forward (hopefully) to get up and running. More information about Laravel sail here: https://laravel.com/docs/8.x/sail

You will need Docker installed on the machine you are testing and any existing containers that are running must be stopped.

I have included the vendor folder and `.env` file with pusher variables defined to make setting up easier.

You will need to run the following commands from the root of the project.
```
// Start the containers (may take a while to begin with)
./vendor/bin/sail sail up -d

// Install composer packages
./vendor/bin/sail composer install

// Run the migrations
./vendor/bin/sail artisan migrate

// Compile the front end(if required)
./vendor/bin/sail npx mix

// Run the PHP unit tests
./vendor/bin/sail test
```

Once up and running you should be able to do the following
- Visit http://localhost/
- Register as a user by setting your name, email address and password
- Once registered you will be redirected to the app
- You will need to create a channel to begin, which you can do so in the app
- Once a channel has been created, you will be able to create messages in the channel
- The app uses websockets and pusher to drive the channels and messages being display
- If you create another user and open a private/incognito window you will be able to see this. You will be able to chat without having to reload the page
- You can come back to the app and login with an existing user to continue the conversation
- Users currently viewing the active channel will be shown at the top of the thread 
- There is only one database setup in the containers so when running the tests it may remove any data from it
