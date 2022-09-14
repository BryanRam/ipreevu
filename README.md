## Ipreevu

Ipreevu is a recreation of the CSS Conference Web (<a href="https://github.com/BryanRam/conference_web" target="_blank">conference_web</a>) built in Laravel 9. It is an update from the previous version that was built in an old lightweight version of Laravel called Lumen, and configured to run in Heroku.

You can view Ipreevu live here: <a href="https://ipreevu.herokuapp.com/" target="_blank">https://ipreevu.herokuapp.com/</a>

# Running Ipreevu locally. First time setup
1. Clone the repository.
2. Copy .env.example in the same location and rename it to .env
3. Run `npm install` and `composer install`.
4. Create an MySQL database called ipreevu with a username and password of your choice.
5. In your .env file, make sure your DB_DATABASE, DB_USERNAME, and DB_PASSWORD credentials correspond to the ones used in step 4.
6. In a terminal, run `./vendor/bin/sail up`
7. After the Docker container has been created and all processes are running, 
   run `php artisan migrate:fresh --seed` in a terminal.
8. Navigate to http://localhost:80/

## Running Ipreevu locally after setup
1. In a terminal, run `./vendor/bin/sail up`
2. Navigate to http://localhost:80/