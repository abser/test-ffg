## Gravity - Fitness First

Import if not exist database 'sprim_dhs'

Installation:

1. Create vhost gravity.local on https
2. Create database 'gravity_local'
3. Run sudo chown -R [your-username] /dir/to/project
4. Run sudo chmod -R 777 /dir/to/project/app/storage
5. Run php artisan migrate --package=cartalyst/sentry --env=local
6. Run php artisan migrate --env=local
7. Run php artisan db:seed --env=local





