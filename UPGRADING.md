Upgrading manual
================

If there is no description for the specific version, then upgrading does not require any code change. In other case
follow the instructions.

From 1.1.0 to 1.2.0
-------------------------------

### Validation
In some models empty string values are not allowed, please set `null` instead of empty
string in optionally `string` properties. For example:

```php
// do
$phone = new ContactPhone(phoneNumber: null, mobileNumber: null);

# instead of
$phone = new ContactPhone(phoneNumber: '', mobileNumber: '');
```

Some models has built-in validation, so an `InvalidDataException` is thrown if 
the value doesn´t meet the validation rules.

### Built-in input sanitization
As it mentioned, if a model has values that doesn't meet their rules `InvalidDataException` is thrown.
This version has some sanitization methods to remove special characters could result in invalid model.

If you want to disable this sanitization on some models, please set:
```php
Reference::disablePrepareData();
```
