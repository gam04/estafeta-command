Comando Estafeta
=========================
[![Total Downloads](https://img.shields.io/packagist/dt/gam/estafeta-command.svg?style=flat-square)](https://packagist.org/packages/gam/estafeta-command)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/gam04/estafeta-command/build?style=flat-square)
![GitHub](https://img.shields.io/github/license/gam04/estafeta-command?style=flat-square)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/gam04/estafeta-command?style=flat-square)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/gam/estafeta-command?style=flat-square)

> PHP library to run 'estafeta interactive command' web portal operations programmatically.

Sponsors
--------
<a href="https://enviosperros.com"><img src="https://enviosperros.com/img/logo/logo.svg" alt="EP" width="247" height="64">
</a>
&nbsp;&nbsp;&nbsp;

Features
--------
- Get Estafeta Account information programmatically:
  - Available services
  - Available content types
- Find Locations by Postal code.
- Find Suburbs (Colonia) by name.
- Create Labels (Guias).

Installation
------------
`composer require gam/estafeta-command`


Usage
---------
This is a simple example:
```php
// 1. set your credentials
$credentials = new Credentials('user', 'password');
$command = new Command($credentials);

// 2. fetch your account data
$account = $command->fetchAccount();
$terrestre = $account->getServiceByName(Service::NEXT_DAY);
$caja = $account->getContentTypeByName(ContentType::BOX);

// 3. Find a Suburb by Postal Code & Name
$originSection= $command->fetchSections('97306')
    ->findBySuburb('LOS HEROES', true)
    ->first();

// 4. Create an Origin Address
$originAddress = new Address('Salome', '587');
// 5. Create an Origin Contact
$originContact = new Contact(
    'Foo',
    'Bar',
    new Rfc('Foo Company'),
    'foo@bar.com',
    new ContactPhone('', '00000000')
);
// 6. Create the Origin
$origin = new Location(
    '', // not necessary
    $originSection,
    $originAddress,
    LocationCategory::OTHERS(),
    LocationType::ORIGIN(),
    $originContact
);

// 7. Find Destination Section by postal code
$destinationSection = $command->fetchSections('81000')
    ->findBySuburb('CENTRO', true)
    ->first();

// 8. Create Destination Address
$destinationAddress = new Address('Vicente Guerrero', '790', '2');
// 9. Create Destination Contact
$destinationContact = new Contact(
    'Foo',
    'Bar',
    new Rfc('Bar SA')
);
// 10. Create the Destination
$destination = new Location(
    '', // not necessary
    $destinationSection,
    $destinationAddress,
    LocationCategory::OTHERS(),
    LocationType::DESTINATION(),
    $destinationContact
);
// 11. Set Print Config
$pringConfig = new PrintConfig(PrintType::LOCAL(), PaperType::BOND());

// 12. Build the Label.
$labelParameters = (new \Gam\Estafeta\Command\LabelParametersBuilder())
    ->withAccount($account)
    ->withService($terrestre)
    ->withContentType($caja)
    ->withPackage(new Package(
        14.0,
        new \Gam\Estafeta\Command\Model\Dimension(57, 57, 21),
        'Vasos termicos'
    ))
    ->withPackagingType(PackagingType::PACKAGE())
    ->withOrigin($origin)
    ->withDestination($destination)
    ->withPrintConfig($pringConfig)
    ->build();

$label = $command->createLabel($labelParameters);

// store the label file
file_put_contents("{$label->getId()}.pdf", $label->getPdf());

// finally, close the session
$command->logout();
```



Contributing
------------
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

License
----------------------------
The Apache License. Please see [License File](LICENSE) for more information.

Credits
-------
- [Gamboa Aguirre](https://github.com/gam04)

Todo
------
- **Setup a CD workflow**: I need a secret file to run the tests
- **Validate models**: Validate Model properties according to Estafeta Web App Rules.
- **Improve docs**: Maybe ReadTheDocs, using markdown, etc...