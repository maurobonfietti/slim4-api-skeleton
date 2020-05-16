<?php

declare(strict_types=1);

final class PostCreateProjectCommand
{
    public static function showMessage(): void
    {
        echo <<<EOF
   _____ _ _             _  _              
  / ____| (_)           | || |             
 | (___ | |_ _ __ ___   | || |_            
  \___ \| | | '_ ` _ \  |__   _|           
  ____) | | | | | | | |    | |             
 |_____/|_|_|_| |_| |_|    |_| _____ _____ 
  / ____| |      | |     /\   |  __ \_   _|
 | (___ | | _____| |    /  \  | |__) || |  
  \___ \| |/ / _ \ |   / /\ \ |  ___/ | |  
  ____) |   <  __/ |  / ____ \| |    _| |_ 
 |_____/|_|\_\___|_| /_/    \_\_|   |_____|

*************************************************************
Project: https://github.com/maurobonfietti/slim4-api-skeleton
*************************************************************

Successfully created project!

Get started with the following commands:

$ cd [my-api-name]
$ composer test
$ composer start

(P.S. set your MySQL connection in .env file)

Thanks for installing this project!

Now go build a cool RESTful API ;-)

EOF;
    }
}

PostCreateProjectCommand::showMessage();
