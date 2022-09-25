@webiste: http://foostart.com

@package-name: package-front
@author: Kang
@date: 27/12/2017
@version: 2.0

@features

1. CRUD
2. Add category to form
3. Language standard
4. Add filters on table data
5. Add token for prevent XSRF


Step 1: Install package-front

composer require foostart/package-front

Step 2: Install Minify HTML/JS/CSS

composer require matthiasmullie/minify

Step 3: Publish config, view, assets

php artisan vendor:publish --provider="Foostart\Front\FrontServiceProvider" --force

Step 4: Set config dir block

config/package-front.php

'dir' => [
        'source_blocks' => '*\trunk\public\template',
        'asset' => '*\trunk\public\packages\foostart\package-front\\',
],

Step 5: Install blocks

Access URL: */install-blocks


Step 6: Convert LESS to CSS

Run cmd
package-front/public/script/convert.php