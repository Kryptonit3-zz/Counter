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

Enjoy!

##### To-Do List
+ Add Caching


Package influenced by: https://github.com/defuse/phpcount

Pull requests are welcome.


