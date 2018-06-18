# DARSER

Parser that can convert a CSV file into an XML file using PHP.

## Getting Started

Parser that can convert a CSV file into an XML file using PHP but it can be extended easily to parse more file types.

While converting will anonymize email addresses or phone numbers. Emails and phones numbers can be alone in a field or on the same line with other text.

As an optional parameter you can use the first line of the CSV file as a header (if it has one) to use on XML field names.


### Usage example

```php
$parser = new Darser('CSV','XML');

$parser->input->load('input.csv');
$parser->convert(true); //set to false if first line don't contain headers
$parser->output->save('output.xml');
echo "File converted Succesfully";
```

## Built With

* Love
* Hope
* [PHPUNIT] - Used to test
* :)

## Authors

* **David** - *Initial work* - [David](https://github.com/dravek)
