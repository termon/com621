# Notes

## Recreate database and Seed
php artisan migrate:fresh --seed

## Migration onDelete
add onDelete('cascade') to relationships where related data should be deleted with parent

```php
  $table->foreignId('book_id')->constrained()->onDelete('cascade');
```

## Shortcuts

Cmd P         - quick open
Shift Cmd P   - show command pallet
Cmd 0 Cmd <-  - collapse explorer folders
Cmd B         - toggle explorer view
Cmd K Cmd W   - close all editor windows


# CSS
prepend ! operator to ensure it overrides definition in component e.g. !p-0 would override any existing p style in component