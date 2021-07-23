<?php

namespace app\core;
/*
* @author     Kunkuma Geeth Prasanna <kunkumagp@gmail.com>
* @package    app\core
*/

use app\core\Application;

class Make  
{

    public $migrationPath;
    public function __construct()
    {
        $migrationPath = 'database/migrations/';
        $this->migrationPath = $migrationPath;
    }

    public function migration($argv)
    {

        $className = $argv[3];
        if($this->checkMigrationClass('Create'.$className)===true){
            echo "A migration file with '$className' class name, already exist in the application. Try with different class name.";
        } else {
            $argumentArray = explode(' ', preg_replace("([A-Z])", " $0", $className));
            foreach ($argumentArray as $key => $value) {if($value === ""){unset($argumentArray[$key]);}}
            $fileName = date("Y_m_d_").time().'_create_'.strtolower(implode('_', $argumentArray)).'.php';
            if($argv[2] === 'migration')
            {
                $file = fopen($this->migrationPath.$fileName, "w") or die("Unable to open file!");
                $content = "<?php\n\nclass Create$className extends Migration\n{\n // Run the migrations.\n}";
                fwrite($file, $content);
                fclose($file);
                echo $fileName.' has been created.';
            }
        }
        
    }

    public function checkMigrationClass($className)
    {
        $dircont = scandir($this->migrationPath);
        $exist = false;
        foreach ($dircont as $key => $value) {
            if ('.' !== $value && '..' !== $value){
                $php_code = file_get_contents($this->migrationPath.$value);
                if(strpos($php_code, $className) !== false){
                    $exist = true;
                }
            }
        }
        return $exist;
    }
}
