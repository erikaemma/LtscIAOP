# IAPO


## Usage

+ Method 1

```php
//Your class instance
$myObj = new MyObj();
//You can add one $before and one $after there,
//or add after
$demo = new AOP($myObj);
$demo->addBefore(function($method, $arguments) {
    //do something
    //$method and $arguments recv the method(argument[])
});
$demo->addAfter(function($result, $method, $arguments) {
    //do something
    //$result recv the return of method(argument[])
});
$demo->myFunc(...something...);
```

+ Method 2

  You can just write your class that extends the AOP class, then you can get IDE's automatic prompt.

## Standard

**$before and $after must return a bool.**

## thrown

+ `AopException`

  + When `set` or `add` something failed;
  + When the `myFunc` in `$myObj` not exists.

+ `CallException`

  + When any callback of $before or $after return false