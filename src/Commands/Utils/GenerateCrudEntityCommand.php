<?php

namespace App\Commands\Utils;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCrudEntityCommand extends Command
{
    const COMMAND_VERSION = '0.0.2';

    public function __construct($app)
    {
        parent::__construct();
        $this->container = $app->getContainer();
    }

    protected function configure()
    {
        $this->setName('app:generate:entity:endpoints')
            ->setDescription('Generate CrudEntity Command')
            ->setHelp('This command Generate CrudEntity Command. Version: ' . self::COMMAND_VERSION)
            ->addArgument(
                'entity',
                InputArgument::REQUIRED,
                'Enter the name for the entity/table, to generate CRUD endpoints.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting!');

        // Get Entity Name.
        $entityName = $input->getArgument('entity');
        $output->writeln('Generate New Entity: ' . $entityName);
        $entityNameUpper = ucfirst($entityName);

        // Get Entity Fields.
        $db = $this->container->get('db');
        $query = "DESC `$entityName`";
        $statement = $db->prepare($query);
        $statement->execute();
        $fields = $statement->fetchAll();

        // Get Dynamic Params and Fields List.
        $paramList = '';
        $paramList2 = '';
        $paramList3 = '';
        $paramList4 = '';
        $paramList5 = '';
        foreach ($fields as $field) {
            $paramList.= sprintf("`%s`, ", $field['Field']);
            $paramList2.= sprintf(":%s, ", $field['Field']);
            $paramList3.= sprintf('$statement->bindParam(\'%s\', $%s->%s);%s', $field['Field'], $entityName, $field['Field'], PHP_EOL);
            $paramList3.= sprintf("%'\t1s", '');
            if ($field['Field'] != 'id') {
                $paramList4.= sprintf("`%s` = :%s, ", $field['Field'], $field['Field']);
                $paramList5.= sprintf("if (isset(\$data->%s)) { $%s->%s = \$data->%s; }%s", $field['Field'], $entityName, $field['Field'], $field['Field'], PHP_EOL);
                $paramList5.= sprintf("%'\t1s", '');
            }
        }
        $fieldList = substr_replace($paramList, '', -2);
        $fieldList2 = substr_replace($paramList2, '', -2);
        $fieldList3 = substr_replace($paramList3, '', -2);
        $fieldList4 = substr_replace($paramList4, '', -2);
        $fieldList5 = substr_replace($paramList5, '', -2);

        // Get Base Query For Insert Function.
        $insertQueryFunction = '$query = \'INSERT INTO `'.$entityName.'` ('.$fieldList.') VALUES ('.$fieldList2.')\';
        $statement = $this->getDb()->prepare($query);
        '.$fieldList3.'
        $statement->execute();

        return $this->checkAndGet'.$entityNameUpper.'((int) $this->getDb()->lastInsertId());';

        // Get Base Query For Update Function.
        $updatequeryFunction = ''.$fieldList5.'

        $query = \'UPDATE `'.$entityName.'` SET '.$fieldList4.' WHERE `id` = :id\';
        $statement = $this->getDb()->prepare($query);
        '.$fieldList3.'
        $statement->execute();

        return $this->checkAndGet'.$entityNameUpper.'((int) $'.$entityName.'->id);';

        // Add Routes.
        $routes = '
$app->group("/'.$entityName.'", function () use ($app) {
    $app->get("", "App\Controller\\'.ucfirst($entityName).'\GetAll");
    $app->get("/[{id}]", "App\Controller\\'.ucfirst($entityName).'\GetOne");
    $app->post("", "App\Controller\\'.ucfirst($entityName).'\Create");
    $app->put("/[{id}]", "App\Controller\\'.ucfirst($entityName).'\Update");
    $app->delete("/[{id}]", "App\Controller\\'.ucfirst($entityName).'\Delete");
});
';
        $file = __DIR__ . '/../../App/Routes.php';
        $content = file_get_contents($file);
        $content.= $routes;
        file_put_contents($file, $content);

        // Add Repositories.
        $repository = '
$container["'.$entityName.'_repository"] = function (ContainerInterface $container): App\Repository\\'.ucfirst($entityName).'Repository {
    return new App\Repository\\'.ucfirst($entityName).'Repository($container->get("db"));
};
';
        $file = __DIR__ . '/../../App/Repositories.php';
        $repositoryContent = file_get_contents($file);
        $repositoryContent.= $repository;
        file_put_contents($file, $repositoryContent);

        // Add Services.
        $service = '
$container["'.$entityName.'_service"] = function (ContainerInterface $container): App\Service\\'.ucfirst($entityName).'Service {
    return new App\Service\\'.ucfirst($entityName).'Service($container->get("'.$entityName.'_repository"));
};
';
        $file = __DIR__ . '/../../App/Services.php';
        $serviceContent = file_get_contents($file);
        $serviceContent.= $service;
        file_put_contents($file, $serviceContent);

        // Copy CRUD Template.
        $source = __DIR__ . '/../../Commands/SourceCode/Objectbase';
        $target = __DIR__ . '/../../Controller/' . ucfirst($entityName);
        shell_exec("cp -r $source $target");

        // Replace CRUD Controller Template for New Entity.
        $base = $target . '/Base.php';
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityNameUpper/g' $base");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $base");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityNameUpper/g' $target/Create.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $target/Create.php");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityNameUpper/g' $target/Delete.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $target/Delete.php");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityNameUpper/g' $target/GetAll.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $target/GetAll.php");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityNameUpper/g' $target/GetOne.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $target/GetOne.php");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityNameUpper/g' $target/Update.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $target/Update.php");

        // Remove Any Temp Files.
        shell_exec("rm -f $target/*.bkp");

        // Replace and Update Exceptions
        $source = __DIR__ . '/../../Commands/SourceCode/ObjectbaseException.php';
        $target = __DIR__ . '/../../Exception/' . ucfirst($entityName). 'Exception.php';
        shell_exec("cp $source $target");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityNameUpper/g' $target");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $target");
        shell_exec("rm -f $target.bkp");

        // Replace and Update Services.
        $source = __DIR__ . '/../../Commands/SourceCode/ObjectbaseService.php';
        $target = __DIR__ . '/../../Service/' . ucfirst($entityName). 'Service.php';
        shell_exec("cp $source $target");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityNameUpper/g' $target");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $target");
        shell_exec("rm -f $target.bkp");

        // Replace and Update Repository.
        $source = __DIR__ . '/../../Commands/SourceCode/ObjectbaseRepository.php';
        $target = __DIR__ . '/../../Repository/' . ucfirst($entityName). 'Repository.php';
        shell_exec("cp $source $target");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityNameUpper/g' $target");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $target");
        shell_exec("rm -f $target.bkp");

        // Replace and Update Repository with Insert Query Function.
        $entityRepository = file_get_contents($target);
        $repositoryData = preg_replace("/".'#createFunction'."/", $insertQueryFunction, $entityRepository);
        file_put_contents($target, $repositoryData);

        // Replace and Update Repository with Update Query Function.
        $entityRepositoryUpdate = file_get_contents($target);
        $repositoryDataUpdate = preg_replace("/".'#updateFunction'."/", $updatequeryFunction, $entityRepositoryUpdate);
        file_put_contents($target, $repositoryDataUpdate);

        $output->writeln('Script Finish ;-)');
    }
}
