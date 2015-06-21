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

For regular pages you just add `Counter::show('home')` (for blades uses `{{ Counter::show('home') }}`. Change `home` to a unique name for the page you are working with.

For dynamic pages, such as user profiles, or job listings etc you may provide a dynamic element like this `Counter::show('user-profile', $user->id)` ( for blades use `{{ Counter::show('user-profile', $user->id) }}` ) Change `user-profile` to a unique name for the page you are working with.

Number output is already formatted. So 3000 visitors will render as 3,000

Enjoy!

##### To-Do List
+ Add Caching


Package influenced by: https://github.com/defuse/phpcount


