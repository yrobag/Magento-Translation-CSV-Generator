#Magento Translation CSV Generator

PHP Script to generate csv file with all phrases that should be translate in specific directory (phrases are searched recursively)

Script Arguments:
- --path(-p) Path to directory which should be searched [default: '.']
- --file(-f) output file [defualt: 'translations.csv']


###Sample of usage
```console
 php createTranslations.php -p 'vendor/magento/module-catalog' -f 'pl_Pl.csv'
```