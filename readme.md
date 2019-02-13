## Pdf gallery based on Laravel and ReactJS
## Example Task:
1. Create single page app with thumbnails of the first page of PDF document. There should be 4 x 5 thumbnails per page.
2. When clicking on thumbnail, full document should be shown in full screen modal window.
3. On top of the list page there is "add new document" button with document upload window.
4. Once document is uploaded, it is shown at the end of the thumbnails list.
5. All communication from the front to backend should be through REST API.
6. Use any database of your choice (MySQL, PostgreSQL, SQLite, Redis, NoSQL, ....)
7. For backend/front please use Laravel or Lumen.
8. For frontend you are free to use any framework of your choice.
9. Code should be delivered using gitlab, github, or bitbucket
10. Code should be PSR-2 valid
11. Code should be covered with functional tests

## Status
Partially done. Pls see todo section

## Todo:
1. Pagination
2. Write more functional tests
3. Add seeds

## What have been used
1. ReactJs
2. Laravel 5.7
3. Some helpful packages

## Installation
1. Clone repo
```git clone https://github.com/yoshkin/reactjs-laravel-pdf-gallery-example.git pdf-gallery-example```
2. Change dir
```cd pdf-gallery-example```
3. ```composer install```
4. ```npm install```
5. ```php artisan storage:link```
6. Create your database
7. Change your ENV setting (for example):
```
   APP_URL=http://pdf-gallery-example.local
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pdf_gallery
   DB_USERNAME=root
   DB_PASSWORD=
```

And in the end:
1. ```php artisan migrate```
2. ```npm run development``` or ```npm run production```

PS: you can also use ```php artisan serve```. But you need to change $baseUrl property in MyTestCase class.

## Tests
- phpunit

Need to write more tests

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
