## Hit Counter for Laravel 5.*

#### Installation

Run the following commands:

~~~
composer require kryptonit3/counter

php artisan vendor:publish --provider="Kryptonit3\Counter\CounterServiceProvider" --tag="migrations"

php artisan migrate
~~~

Add the following to your `config\app.php` Service Providers

`Kryptonit3\Counter\CounterServiceProvider::class,`

Add the following to your `config\app.php` Facades

`'Counter'       => Kryptonit3\Counter\Facades\CounterFacade::class,`

#### How to Use

For regular pages you just add `Counter::showAndCount('home')` ( for blades uses `{{ Counter::showAndCount('home') }}` ). Change `home` to a unique name for the page you are working with.

For dynamic pages, such as user profiles, or job listings etc you may provide a dynamic element like this `Counter::showAndCount('user-profile', $user->id)` ( for blades use `{{ Counter::showAndCount('user-profile', $user->id) }}` ) Change `user-profile` to a unique name for the page you are working with.

Number output is already formatted. So 3000 visitors will render as 3,000

If you have records on a page but do not want to count visiting the page displaying the records as a hit on the record itself then change `showAndCount` to just `show`. Example `Counter::show('job-listings', $job->id)` ( for blades use `{{ Counter::show('job-listings', $job->id) }}` )

You may get all hits for every page on the entire site with `Counter::allHits()` ( for blades use `{{ Counter::allHits() }}` ). To specify a day constraint, like only all hits for the past 30 days then do `Counter::allHits(30)` (for blades use `{{ Counter::allHits(30) }}` ).

If you would just like to process a hit for a page without displaying anything then just use `Counter::count('user-profile', $user->id)`. Works the same as all previous examples for both static and dynamic pages, blade is the same syntax. Useful for counting hits for a page without letting everyone see.

Enjoy!

##### To-Do List
+ Add Caching


Package influenced by: https://github.com/defuse/phpcount

Pull requests are welcome.

How this differs from: https://github.com/weboAp/Visitor

This package lets you see hit counts for specific pages/objects as well as an overall site hit count.

Yes, it uses IP addresses so it is not 100% accurate. P.S. IP addresses are hashed so it would be quite a daunting task to decode the data. Nice package for the pro-anonymous people :)

~~~
mysql> select * from kryptonit3_counter_page;
+----+--------------------------------------+---------------------+---------------------+
| id | page                                 | created_at          | updated_at          |
+----+--------------------------------------+---------------------+---------------------+
|  1 | 83d2bf80-e87f-5262-a71e-7bdb31a971bb | 2015-06-21 20:50:31 | 2015-06-21 20:50:31 |
|  2 | 4b31a3db-8457-5f21-87dd-700ad873c9c1 | 2015-06-21 21:23:49 | 2015-06-21 21:23:49 |
|  3 | d22d3d13-4852-58ec-b14d-37b1c681dd7c | 2015-06-21 21:36:23 | 2015-06-21 21:36:23 |
+----+--------------------------------------+---------------------+---------------------+
3 rows in set (0.00 sec)

mysql> select * from kryptonit3_counter_visitor;
+----+------------------------------------------------------------------+---------------------+---------------------+
| id | visitor                                                          | created_at          | updated_at          |
+----+------------------------------------------------------------------+---------------------+---------------------+
|  1 | 8ddb5d9b89caff4b9da3505d39c4bdb02981eb0fd7826beffb5dd817373e72d3 | 2015-06-21 21:09:19 | 2015-06-21 21:09:19 |
|  2 | 2bdabb65e4fb2994a61b25e67b37033429248e78e3ab449bc058f20ec5ce7c33 | 2015-06-21 21:23:49 | 2015-06-21 21:23:49 |
|  3 | 4d5f19cfee318f62de0ab7be85e62de3ad70aa1e51c72489bef626c284cf852b | 2015-06-21 21:36:23 | 2015-06-21 21:36:23 |
+----+------------------------------------------------------------------+---------------------+---------------------+
3 rows in set (0.00 sec)

mysql> select * from kryptonit3_counter_page_visitor;
+---------+------------+---------------------+---------------------+
| page_id | visitor_id | created_at          | updated_at          |
+---------+------------+---------------------+---------------------+
|       1 |          1 | 2015-06-21 21:09:19 | 2015-06-21 21:09:19 |
|       2 |          2 | 2015-06-21 21:23:49 | 2015-06-21 21:23:49 |
|       3 |          3 | 2015-06-21 21:36:23 | 2015-06-21 21:36:23 |
+---------+------------+---------------------+---------------------+
3 rows in set (0.00 sec)
~~~

