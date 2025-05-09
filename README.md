# Laravel Queues

## List of commands

### Create a Job from CLI
-php artisan make:job SendBookReport

### Dependencies
-composer require barryvdh/laravel-dompdf (for PDF generation)

### Initialize queues
php artisan queue:work  (to start the queue worker with the default name)
php artisan queue:work --queue=reports    (to start the queue worker with the name report)
php artisan queue:work --tries=3 --timeout=5 (to start the queue worker with 3 tries and 5 seconds timeout)

### Tinker console
- php artisan tinker   (to start the tinker console to the database)
- $book = new \App\Models\Book(); $book->title = "Test Book"; $book->description = "Test description"; $book->author_id = 1; $book->category_id = 1; $book->price = 19.99; $book->stock = 10; $book->save(); (populates de database)
- DB::table('jobs')->get(); (in the tinker console to see the jobs in the queue)

### Requests
- http POST http://127.0.0.1:8000/books/report email=willoid.webdev@gmail.com book_id=1





    
