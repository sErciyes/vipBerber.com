<?php
namespace vipBerber;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class DB {
    private static $capsule;

    public static function connect() {
        if (self::$capsule === null) {
            self::$capsule = new Capsule;
            self::$capsule->addConnection([
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'dbberber',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'prefix' => '',
            ]);

            // Set the event dispatcher used by Eloquent models... (optional)
            self::$capsule->setEventDispatcher(new Dispatcher(new Container));

            // Make this Capsule instance available globally via static methods... (optional)
            self::$capsule->setAsGlobal();

            // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
            self::$capsule->bootEloquent();
        }

        return self::$capsule;
    }
}
