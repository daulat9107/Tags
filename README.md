
## Introduction

Daulat taggy with spam protection for laravel framework


Run the Composer command to install daulat/taggy:

```bash
composer require daulat/taggy
```

Register Service Provider config/app.php

```bash
Daulat\Taggy\Providers\TaggyServiceProvider::class,
```


Register Facade in config/app.php

```bash
'Spam' => Daulat\Taggy\Traits\Spam\Spam::class
```

Add API keys in .env file

```bash
AKISMET_WEBSITE=your-website
AKISMET_SECRET=your-akismet-secret
```
Get API key form [akismet](https://akismet.com) wordpress site

Update config/services.php 

```bash
 'akismet' =>[
   'website'=>env('AKISMET_WEBSITE'),
   'secret' =>env('AKISMET_SECRET'),
 ]
 ```
 
 Create new file in config/spam.php
 
```bash
<?php

return [

'parameter_map'=>[
      'body' => 'comment_content',
      'author' => 'comment_author',
      'author_email' => 'comment_author_email',
]
  
];

```
Next, Run
```bash
php artisan make:auth
php artisam migrate
```
### And add some dummy tags in tag table.

Now you can see example in
```bash
https://www.your-domain.com/topics
```


