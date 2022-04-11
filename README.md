_# Nextropay PHP API Wrapper.
## Requirements
It's recommended to use a newer version of PHP. This library was written in a PHP v7.3+ environment. 
The minimum version we've tested the code against is PHP v 7.3+. Our PHP version compatibility test used a combination of
[PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) and
[PHP Compatability](https://github.com/PHPCompatibility/PHPCompatibility).

A Nextropay Sandbox and Live account with an API keys pair setup (public & private). 
For the latest instructions visit our [online API documentation](https://doc.nextropay.com/) to learn how to setup 
your API Keys and get a link to your account API Keys page.

See the testing section below for additional requirements to test certain commands with testnet coins.

Note this wrapper assumes the format requested for API responses is JSON. 
By default every API call will return JSON unless otherwise specified.

## Installation
**GitHub**

This Nextropay API wrapper can be downloaded directly or cloned with GitHub. To use it in your project either clone this 
repository or download a ZIP to the directory of your choosing.

The minimum files required for usage are those in the source folder, `NextropayAPI.php`, and
`NextropayCurlRequests.php`. 
The whole file should be placed in the `/src` directory.

**Composer**

To install with composer run the following command

    composer require officialmeritinfos/nextropay-php

and then include the following line in your project where you want to use the wrapper's classes.

```php
require_once('your_project_path_to/vendor/autoload.php');
``` 

### Examples
Previewing the scripts in the `/examples` directory in your browser is possible once you have 
setup the public and secret keys in the `someTest.php` file. 
This obviously requires the ability to serve these example PHP files with a web server like Apache.

## Usage
The simplest example is retrieving basic account information.

```php
// Ignore this line if using composer autoload,
// otherwise, manual wrapper usage include the following require:
require_once('/your_installation_path_to/vendor/autoload.php');
use Officialmeritinfos\NextropayPhp\NextropayAPI;

// Create a new API wrapper instance and call to the get basic account information command.
$pubKey = 'your_public_key';
$secKey = 'your_secret_key';
$env = 'TEST'; # either TEST or LIVE

$data=[
    "name"=>"Meritinfos Testnet",
    "description"=>"Buxiscrow is you gateway to secured financial transaction",
    "businessType"=>"1",
    "trustedIps"=>"",
    "pin"=>"472988",
    "whoPay"=>"2"
];

$client = new NextropayAPI($pubKey,$env);
$response = $client->UpdateBusiness($data);

# It is pretty simple to check the response body of our calls and then you can tweak it just as you want
```

## Testing
Currently, our API wrapper only covers for the following methods; all you need to do is to call them 
within your applications and it handles the rest. Reference to our Documentation on how to use these.
The available methods include:

*  `CheckApiKey()`
*  `GetBusiness()`
*  `UpdateBusiness()`
*  `CreateInvoice()`
*  `GetInvoice()`
*  `UpdateInvoice()`
*  `GetInvoiceSettlementStatus()`
*  `CreatePayout()`
*  `GetPayout()`
*  `GetAccountBalance()`
*  `Rate()`
*  `GetBalance()`
*  `SupportedAssets()`
*  `SupportedFiats()`

### Transaction Fees
Test transactions should be done on the sandbox so that you do not lose real money. 

## Contributing
If during your work with this wrapper you encounter a bug or have a suggestion to help improve it 
for others, you are welcome to open a Github issue on this repository and it will be reviewed by 
one of our development team members. The Nextropay bug bounty does not cover this wrapper.

## License
MIT
