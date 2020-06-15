<?php

declare(strict_types=1);

final class PostCreateProjectCommand
{
    public static function showIntro(): void
    {
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

EOF;
    }

    public static function showSuccessMessage(): void
    {
        echo <<<EOF

*************************************************************
Project: https://github.com/maurobonfietti/slim4-api-skeleton
*************************************************************

Successfully created project!

EOF;
    }

    public static function showFinalMessage(): void
    {
        echo <<<EOF

Get started with the following commands:

$ cd [your-api-name]
$ composer test
$ composer start

(P.S. set your MySQL connection in '.env' file)

Thanks for installing this project!

Now go build a cool RESTful API ;-)

EOF;
    }
}

PostCreateProjectCommand::showIntro();
PostCreateProjectCommand::showSuccessMessage();
PostCreateProjectCommand::showFinalMessage();

unlink('.coveralls.yml');
unlink('.travis.yml');
unlink('post-create-project-command.php');
