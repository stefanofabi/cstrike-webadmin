## About cstrike-webadmin

The cstrike-webadmin project tries to be a page that helps administrators by adding the main features to currently manage a server. We facilitate some common tasks such as managing administrators, assigning ranks, banning players, among other things.

### Pre requirements 📋
```
Composer
NPM
PHP 7.x/8.x
Relational database (MySQL, MariaDB)
```

### Installation 🔧

1. Clone the repository on your local machine or server

```
# git clone https://github.com/stefanofabi/cstrike-webadmin.git
```

2. Create a copy of the .env.example file and rename it to .env. Inside we will edit the environment variables to establish the connection to the database

```
# cd cstrike-webadmin
# cp .env.example .env
# vim .env
```

3. Proceed to install the dependencies required for the project and generate the javascript files and styles

```
# composer install
# npm install
# npm run dev
```
4. Create a link to the storage folder that contains everything related to the application and create the application key that will protect user sessions and other data.

```
# php artisan storage:link
# php artisan key:generate
```

5. Finally run the migrations and seeds.

```
# php artisan migrate
# php artisan db:seed
```

6. Running the seeds will allow you to log in with some test users.
```
- Administrator 
Email: admin@community
Password: password
```

Remember to modify passwords in production!

7. Finally you have to connect the servers to the application using the plugin provided


## Contributing

Thank you for considering contributing to the cstrike-webadmin app! You can do it in:
- [MercadoPago](https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c93808479cfe0100179dcd305820bf0)
- [PayPal](https://paypal.me/4evergaming)
- [Bitcoin](https://www.blockchain.com/btc/address/1BxrkKPuLTkYUAeMrxzLEKvr5MGFu3NLpU)

## Hosting
Considering renting a Counter-Strike 1.6 server? Feel free to visit the page of our main sponsor [4evergaming](https://4evergaming.com.ar)
