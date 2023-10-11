# Notes

## Recreate database and Seed
php artisan migrate:fresh --seed

## Migration onDelete
add onDelete('cascade') to relationships where related data should be deleted with parent

```php
  $table->foreignId('book_id')->constrained()->onDelete('cascade');
```