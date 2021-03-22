# Nullable Properties

This package provides automatically nulled properties for Eloquent Models.

When patching an Eloquent Model, it might be common to do something like this:

```php
$this->property = $request->get('property');
```

Or even:

```php
$this->fill($request->all());
```

A side effect of this is that empty fields in forms are stored in the database as empty strings, even when the database column is nullable.

This can interfere with future queries such as:

```
$users = User::whereNull('favoriteColor')->get();
```

## Usage

Usage is simple. Add:
 
 * The `NullableProperties` trait
 * An array named `$nullable`, containing Model property names (similar to arrays like `$fillable` and `$casts`):

```php
<?php

use Illuminate\Database\Eloquent\Model;
use Temper\NullableProperties\NullableProperties;

class User extends Model {
    use NullableProperties;

    public $nullable = ['favoriteColor'];
};
```

Properties in this array are not allowed to be stored as empty strings, they will always default back to `null` when empty.

Laravel can not easily detect nullable values at runtime. but you can easily get a table's nullable properties from the database:

```mysql
select concat('protected $nullable = [', group_concat(concat("'",column_name,"'")),'];')
from information_schema.columns
where table_name = 'users' and is_nullable = 'YES'
and data_type = 'varchar';
```
