<?php

declare(strict_types=1);

echo <<<EOF
   _____ _ _             _  _           
  / ____| (_)           | || |          
 | (___ | |_ _ __ ___   | || |_         
  \___ \| | | '_ ` _ \  |__   _|        
  ____) | | | | | | | |    | |          
 |_____/|_|_|_| |_| |_|    |_|       _  
 |  __ \         | |     /\         (_) 
 | |__) |___  ___| |_   /  \   _ __  _  
 |  _  // _ \/ __| __| / /\ \ | '_ \| | 
 | | \ \  __/\__ \ |_ / ____ \| |_) | | 
 |_|__\_\___||___/\__/_/ _  \_\ .__/|_| 
  / ____| |      | |    | |   | |       
 | (___ | | _____| | ___| |_ _|_| _ __  
  \___ \| |/ / _ \ |/ _ \ __/ _ \| '_ \ 
  ____) |   <  __/ |  __/ || (_) | | | |
 |_____/|_|\_\___|_|\___|\__\___/|_| |_|

\033[36m*************************************************************\033[37m
Project: https://github.com/maurobonfietti/slim4-api-skeleton
\033[36m*************************************************************\033[37m

\033[32mSuccessfully created project!\033[37m

Get started with the following commands:

$ cd [your-api-name]
$ composer test
$ composer start

\033[33mRemember!\033[37m
You need to set the MySQL connection in your dotenv file: '.env'.

\033[32mThanks for installing this project!\033[37m

\033[32mDonate:\033[37m https://ko-fi.com/maurobonfietti

Now go build a cool RESTful API ;-)


EOF;

unlink('.coveralls.yml');
unlink('.travis.yml');
unlink('post-create-project-command.php');
