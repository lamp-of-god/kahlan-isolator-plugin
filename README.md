# What is it?
This plugin allows to 'require' functions from PHP files and skip other code.

# What for?

If you work with old legacy code, there are some situations when unit-testing 
is impossible, for example, when file contains not only functions but also 
side code. This plugin allows you to test isolated functions from files.

# Example of case

For example, you have controller:

```
<?php

if (!authorized()) {
    die('error');
}

do_something();

function to_test() 
{
    return 42;
}
```

It is impossible to test function `to_test`. You can't just require file because 
there is side-code that can break test or can do some unwanted stuff. 
But if function `to_test` isolated by itself, it will be good to test it.

# Usage
With this plugin you can test such functions: 
you just `use` plugin and `require` file with it:

```
use Kahlan\Plugin\Isolator;

Isolator::isolate(dirname(__DIR__).'/../controller.php');

describe('to_test()', function() {
    it('returns 42', function() {
        expect(to_test())->toBe(42);
    });
});
```

After `isolation` controller file will contain only functions 
(and `use` statements) without other code:

```
<?php
function to_test() 
{
    return 42;
}
```

So now it is testable.
