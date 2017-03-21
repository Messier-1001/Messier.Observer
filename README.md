# Messier.Observer

Defines the Messier interfaces and base for using observer design pattern with your
classes.

## Installation

```
composer require messier1001/messier.observer
```

or inside the `composer.json`:

```json
   "require": {
      "php": ">=7.1",
      "messier1001/messier.observer": "^0.1.0"
   },
```

## Usage

You can define one or more observer classes, watching one or more observable classes e.g.
for changes.

For example you have a class `DSN` that should inform a a class `DBConnection`
if something of the `DSN` has changed and the `DBConnection` must be reloaded.

To solve it the are 2 ways.

### Implement IObservable by hand

The one with more work is to implement the `IObservable` interface methods by hand.
This is required if the `DSN` class can not extend from abstract `Observable` class

```php
class DSN extends SomeOtherClass implements \Messier\Observer\IObservable
{

   # Here all the Methods from the interface should be defined
   # Take a lock at Observable for example implementation
   
}
```

### Extend from abstract Observable

This is the easy way. Simple extend your class from the abstract `Observable` class.

The only thing you have to do is call the protected constructor of `Observable` from
inside your class constructor

```php
class DSN extends \Messier\Observer\Observable
{

   public function __construct()
   {
      parent::construct();
   }
   
}
```

### Trigger changes

Each change inside the `DSN` class should trigger a notify call that informs the
observers about the changes.

```php
   public function setDbName( string $dbName ) : DSN
   {
   
      if ( $this->_dbName === $dbName )
      {
         // Nothing is changed, ignore it
         return;
      }
      
      // Remember the new DB name
      $this->_dbName = $dbName;
      
      // Notify all observers
      $this->notify( [ 'property' => 'dbName' ] );
      
      // Return this instance for fluent usage
      return $this;
      
   }
```


### The observer

The `Observer` is the `DBConnection` class.

It must implement all methods from `Messier\Observer\IObserver` interface.

```php
class DBConnection implements IObserver
{
   
   # …
   
}
```

The Observer (`DBConnection`) is notified by the observable (`DSN`) about changes by
calling Observer::onUpdate() from observable.

The rest: Read the source comments or the example :-)