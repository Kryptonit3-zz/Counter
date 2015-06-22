## Hit Counter for Laravel 5.*

#### Installation

Run the following command: `composer require kryptonit3/counter`

Add the following to your `config\app.php` Service Providers

`Kryptonit3\Counter\CounterServiceProvider::class,`

Add the following to your `config\app.php` Facades

`'Counter'       => Kryptonit3\Counter\Facades\CounterFacade::class,`

Then run the following:

~~~
php artisan vendor:publish --provider="Kryptonit3\Counter\CounterServiceProvider" --tag="migrations"

php artisan migrate
~~~

#### How to Use

For regular pages you just add `Counter::showAndCount('home')` ( for blades uses `{{ Counter::showAndCount('home') }}` ). Change `home` to a unique name for the page you are working with.

For dynamic pages, such as user profiles, or job listings etc you may provide a dynamic element like this `Counter::showAndCount('user-profile', $user->id)` ( for blades use `{{ Counter::showAndCount('user-profile', $user->id) }}` ) Change `user-profile` to a unique name for the page you are working with.

Number output is already formatted. So 3000 visitors will render as 3,000

If you have records on a page but do not want to count visiting the page displaying the records as a hit on the record itself then change `showAndCount` to just `show`. Example `Counter::show('job-listings', $job->id)` ( for blades use `{{ Counter::show('job-listings', $job->id) }}` )

You may get all hits for every page on the entire site with `Counter::allHits()` ( for blades use `{{ Counter::allHits() }}` ). To specify a day constraint, like only all hits for the past 30 days then do `Counter::allHits(30)` (for blades use `{{ Counter::allHits(30) }}` ).

If you would just like to process a hit for a page without displaying anything then just use `Counter::count('user-profile', $user->id)`. Works the same as all previous examples for both static and dynamic pages, blade is the same syntax. Useful for counting hits for a page without letting everyone see.

Enjoy!

Package influenced by: https://github.com/defuse/phpcount

Pull requests are welcome.

How this differs from: https://github.com/weboAp/Visitor

This package lets you see hit counts for specific pages/objects as well as an overall site hit count.

Yes, it uses IP addresses so it is not 100% accurate. P.S. IP addresses are [hashed and salted](https://github.com/Kryptonit3/Counter/blob/master/src/Counter.php#L157-L162) so it would be quite a daunting task to decode the data. Nice package for the pro-anonymous people :)

~~~
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
~~~

