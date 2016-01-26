## Hit Counter for Laravel 5.*

#### Installation

Run the following command: 
```php
composer require kryptonit3/counter:5.2.*
```

Add the following to your `config\app.php` Service Providers

```php
Kryptonit3\Counter\CounterServiceProvider::class,
```

Add the following to your `config\app.php` Facades

```php
'Counter' => Kryptonit3\Counter\Facades\CounterFacade::class,
```

Then run the following:

```bash
php artisan vendor:publish --provider="Kryptonit3\Counter\CounterServiceProvider" --tag="migrations"

php artisan migrate
```

### How to Use

#### Regular pages
Just add `Counter::showAndCount('home')` ( for blades uses `{{ Counter::showAndCount('home') }}` ). Change `home` to a unique name for the page you are working with.

#### Dynamic pages
For dynamic pages, such as user profiles, or job listings etc you may provide a dynamic element like this `Counter::showAndCount('user-profile', $user->id)` ( for blades use `{{ Counter::showAndCount('user-profile', $user->id) }}` ) 
> Change `user-profile` to a unique name for the page you are working with.

Number output is already formatted. So 3000 visitors will render as 3,000

If you have records on a page but do not want to count visiting the page displaying the records as a hit on the record itself then change `showAndCount` to just `show`. Example `Counter::show('job-listings', $job->id)` ( for blades use `{{ Counter::show('job-listings', $job->id) }}` )

You may get all hits for every page on the entire site with `Counter::allHits()` ( for blades use `{{ Counter::allHits() }}` ). To specify a day constraint, like only all hits for the past 30 days then do `Counter::allHits(30)` (for blades use `{{ Counter::allHits(30) }}` ).

If you would just like to process a hit for a page without displaying anything then just use `Counter::count('user-profile', $user->id)`. Works the same as all previous examples for both static and dynamic pages, blade is the same syntax. Useful for counting hits for a page without letting everyone see.

Enjoy!

### Extra
* Package influenced by: [defuse/phpcount](https://github.com/defuse/phpcount "defuse/phpcount") 
* How this differs from: [weboAp/Visitor](https://github.com/weboAp/Visitor "weboAp/Visitor") 

This package lets you see hit counts for specific pages/objects as well as an overall site hit count. It also uses a uniquely generated cookie (fallback to IP) to give a more accurate reading. Nice package for the pro-anonymous people :)

```bash
mysql> select * from kryptonit3_counter_page;
+----+--------------------------------------+
| id | page                                 |
+----+--------------------------------------+
|  2 | 24d83c12-a1e0-598b-93ee-df05ae3f87e7 |
|  1 | 597e0526-152f-5fc0-9d44-b51fd9e45b8f |
+----+--------------------------------------+
2 rows in set (0.00 sec)

mysql> select * from kryptonit3_counter_visitor;
+----+------------------------------------------------------------------+
| id | visitor                                                          |
+----+------------------------------------------------------------------+
|  1 | 88a5f67524a1bc75da5ea8b7250e8280c78d60dce59b129dc37123b137ce6199 |
+----+------------------------------------------------------------------+
1 row in set (0.00 sec)

mysql> select * from kryptonit3_counter_page_visitor;
+---------+------------+---------------------+
| page_id | visitor_id | created_at          |
+---------+------------+---------------------+
|       1 |          1 | 2015-06-22 17:52:43 |
|       2 |          1 | 2015-06-22 17:52:43 |
+---------+------------+---------------------+
2 rows in set (0.00 sec)
```

## Pull requests are welcome.

