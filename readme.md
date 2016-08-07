# Note-Taker Web App

Description

## Getting started

```
git clone https://github.com/kothman/notes.git
cd notes
composer update
cp .env.example .env
#update database variables in .env file
php artisan key:generate;
php artisan migrate
npm install
gulp
```

Anything involving emails will require you to [setup an email driver with Laravel](https://laravel.com/docs/5.2/mail).

## Contributing

Take a look at the open issues to see what sort of things I need help with. If you have ideas for new features or functionality, open an issue and I'll be glad to talk about it with you.

## License

[MIT license](http://opensource.org/licenses/MIT).
