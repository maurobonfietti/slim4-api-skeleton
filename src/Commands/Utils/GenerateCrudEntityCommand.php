<?php

namespace App\Commands\Utils;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCrudEntityCommand extends Command
{
    const COMMAND_VERSION = '0.0.1';

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
            ->addArgument('entity', InputArgument::REQUIRED, 'Enter the name for the entity/table, to generate CRUD endpoints.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start!');

        $entityName = $input->getArgument('entity');
        $output->writeln('Generate New Entity: ' . $entityName);
        $entityName2 = ucfirst($entityName);

        $db = $this->container->get('db');
        $query = "DESC `$entityName`";
        $statement = $db->prepare($query);
        $statement->execute();
        $fields = $statement->fetchAll();
//        var_dump($fields);

        $paramList = '';
        $paramList2 = '';
        $paramList3 = '';
        $paramList4 = '';
        $paramList5 = '';
        foreach ($fields as $field) {
//            var_dump($field['Field']);
            $paramList.= sprintf("`%s`, ", $field['Field']);
            $paramList2.= sprintf(":%s, ", $field['Field']);
            $paramList3.= sprintf('$statement->bindParam(\'%s\', $%s->%s);%s', $field['Field'], $entityName, $field['Field'], PHP_EOL);
            $paramList3.= sprintf("%'\t1s", '');
            if ($field['Field'] != 'id') {
                $paramList4.= sprintf("`%s` = :%s, ", $field['Field'], $field['Field']);
                $paramList5.= sprintf("if (isset(\$data->%s)) { $%s->%s = \$data->%s; }%s", $field['Field'], $entityName, $field['Field'], $field['Field'], PHP_EOL);
                $paramList5.= sprintf("%'\t1s", '');
            }
//            exit;
        }
        $fieldList = substr_replace($paramList, '', -2);
        $fieldList2 = substr_replace($paramList2, '', -2);
//        $fieldList3 = $paramList3;
        $fieldList3 = substr_replace($paramList3, '', -2);
        $fieldList4 = substr_replace($paramList4, '', -2);
        $fieldList5 = substr_replace($paramList5, '', -2);
//        $fieldList5 = $paramList5;
//        var_dump($fieldList5); exit;

        $myquery = '$query = \'INSERT INTO `'.$entityName.'` ('.$fieldList.') VALUES ('.$fieldList2.')\';
        $statement = $this->getDb()->prepare($query);
        '.$fieldList3.'
        $statement->execute();

        return $this->checkAndGet'.$entityName2.'((int) $this->getDb()->lastInsertId());';

        $myUpdatequery = ''.$fieldList5.'

        $query = \'UPDATE `'.$entityName.'` SET '.$fieldList4.' WHERE `id` = :id\';
        $statement = $this->getDb()->prepare($query);
        '.$fieldList3.'
        $statement->execute();

        return $this->checkAndGet'.$entityName2.'((int) $'.$entityName.'->id);';

//        var_dump($myUpdatequery); exit;

        /*
        $query = 'UPDATE `objectbase` SET `objectbase` = :objectbase WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $objectbase->id);
        $statement->bindParam('objectbase', $objectbase->objectbase);
        $statement->execute();

        return $this->checkAndGetObjectbase((int) $objectbase->id);
         *          */

        $asd = '
$app->group("/'.$entityName.'", function () use ($app) {
    $app->get("", "App\Controller\\'.ucfirst($entityName).'\GetAll");
    $app->get("/[{id}]", "App\Controller\\'.ucfirst($entityName).'\GetOne");
    $app->post("", "App\Controller\\'.ucfirst($entityName).'\Create");
    $app->put("/[{id}]", "App\Controller\\'.ucfirst($entityName).'\Update");
    $app->delete("/[{id}]", "App\Controller\\'.ucfirst($entityName).'\Delete");
});
';
        $fichero = __DIR__ . '/../../App/Routes.php';
        $actual = file_get_contents($fichero);
        $actual.= $asd;
        file_put_contents($fichero, $actual);

        $asd = '
$container["'.$entityName.'_repository"] = function (ContainerInterface $container): App\Repository\\'.ucfirst($entityName).'Repository {
    return new App\Repository\\'.ucfirst($entityName).'Repository($container->get("db"));
};
';
        $fichero = __DIR__ . '/../../App/Repositories.php';
        $actual = file_get_contents($fichero);
        $actual.= $asd;
        file_put_contents($fichero, $actual);

        $asd = '
$container["'.$entityName.'_service"] = function (ContainerInterface $container): App\Service\\'.ucfirst($entityName).'Service {
    return new App\Service\\'.ucfirst($entityName).'Service($container->get("'.$entityName.'_repository"));
};
';
        $fichero = __DIR__ . '/../../App/Services.php';
        $actual = file_get_contents($fichero);
        $actual.= $asd;
        file_put_contents($fichero, $actual);

        /********/

        $origen = __DIR__ . '/../../Commands/SourceCode/Objectbase';
        $destino = __DIR__ . '/../../Controller/' . ucfirst($entityName);
        shell_exec("cp -r $origen $destino");

//        $entityName2 = ucfirst($entityName);
        $base = $destino . '/Base.php';
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityName2/g' $base");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $base");

        shell_exec("sed -i .bkp -e 's/Objectbase/$entityName2/g' $destino/Create.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $destino/Create.php");

        shell_exec("sed -i .bkp -e 's/Objectbase/$entityName2/g' $destino/Delete.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $destino/Delete.php");

        shell_exec("sed -i .bkp -e 's/Objectbase/$entityName2/g' $destino/GetAll.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $destino/GetAll.php");

        shell_exec("sed -i .bkp -e 's/Objectbase/$entityName2/g' $destino/GetOne.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $destino/GetOne.php");

        shell_exec("sed -i .bkp -e 's/Objectbase/$entityName2/g' $destino/Update.php");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $destino/Update.php");

        shell_exec("rm -f $destino/*.bkp");

        $origen = __DIR__ . '/../../Commands/SourceCode/ObjectbaseException.php';
        $destino = __DIR__ . '/../../Exception/' . ucfirst($entityName). 'Exception.php';
        shell_exec("cp $origen $destino");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityName2/g' $destino");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $destino");
        shell_exec("rm -f $destino.bkp");

        $origen = __DIR__ . '/../../Commands/SourceCode/ObjectbaseService.php';
        $destino = __DIR__ . '/../../Service/' . ucfirst($entityName). 'Service.php';
        shell_exec("cp $origen $destino");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityName2/g' $destino");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $destino");
        shell_exec("rm -f $destino.bkp");

        $origen = __DIR__ . '/../../Commands/SourceCode/ObjectbaseRepository.php';
        $destino = __DIR__ . '/../../Repository/' . ucfirst($entityName). 'Repository.php';
        shell_exec("cp $origen $destino");
        shell_exec("sed -i .bkp -e 's/Objectbase/$entityName2/g' $destino");
        shell_exec("sed -i .bkp -e 's/objectbase/$entityName/g' $destino");
//        shell_exec("sed -i .bkp -e 's/#ppp/$myquery/g' $destino");
        shell_exec("rm -f $destino.bkp");

        $fichero = $destino;
        $actual = file_get_contents($fichero);
//        $actual.= $myquery;
        $myoutput = preg_replace("/".'#ppp'."/", $myquery, $actual);
//        var_dump($output); exit;
        file_put_contents($fichero, $myoutput);

        $fichero = $destino;
        $actual = file_get_contents($fichero);
//        $actual.= $myquery;
        $myoutput = preg_replace("/".'#uuu'."/", $myUpdatequery, $actual);
//        var_dump($output); exit;
        file_put_contents($fichero, $myoutput);

        $output->writeln('End ;-)');
    }
}
