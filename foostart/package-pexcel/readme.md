@webiste: http://foostart.com

@package-name: sample
@author: Kang
@date: 27/12/2017
@version: 2.0

@features

1. CRUD
2. Add category to form
3. Language standard
4. Add filters on table data
5. Add token for prevent XSRF


1. config/app.php
   'providers' => [
   /*
    * Package Service Providers...
      */
      Maatwebsite\Excel\ExcelServiceProvider::class,
      ]

'aliases' => [
...
'Excel' => Maatwebsite\Excel\Facades\Excel::class,
]

2. Publish
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config


## Step 3: Install publish

1. php artisan vendor:publish --provider="Foostart\Pexcel\PexcelServiceProvider" --force

## Step 6: Migrate and Seeder

Run the following

1. php artisan migrate
1. php artisan db:seed


