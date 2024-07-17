
## Getting Started
To get started with this project, follow these steps:

1. Clone the repository using the following command: ```git clone https://github.com/rotyslav/api_shop```
2. Navigate to the master branch of the repository: ```git checkout main```
3. Up containers:  ```docker-compose up -d ```
4. Check containers: ```docker-compose ps```
5. Install project dependencies using Composer: ```composer instal```
6. Update project dependencies using Composer: ```composer update```
7. Publish the config of JWT auth: ```php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"```
8. Generate the jwt-secret key: ```php artisan jwt:secret```
9. Configure the `.env`
10. Migrate: ```php artisan migrate```
11. Seed database: ```php artisan db:seed```
12. Run project: ```php artisan serve```

