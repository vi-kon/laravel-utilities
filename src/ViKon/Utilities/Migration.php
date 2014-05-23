<?php


namespace ViKon\Utilities;

use Illuminate\Database\Schema\Blueprint;

class Migration extends \Illuminate\Database\Migrations\Migration
{
    private $actualTableName = null;
    private $tables = array();
    private $foreignKeys = array();

    public function up()
    {
        try
        {
            foreach (array_keys($this->tables) as $name)
            {
                $this->actualTableName = $name;
                \Schema::create($name, $this->tables[$name]['callback']);
                $this->actualTableName = null;
            }
            foreach ($this->foreignKeys as $foreignKey)
            {
                $table         = $foreignKey['table'];
                $column        = $foreignKey['column'];
                $foreignTable  = $foreignKey['foreignTable'];
                $foreignColumn = $foreignKey['foreignColumn'];
                $onUpdate      = $foreignKey['onUpdate'];
                $onDelete      = $foreignKey['onDelete'];

                $callback = function (Blueprint $table) use ($column, $foreignTable, $foreignColumn, $onUpdate, $onDelete)
                {
                    $table->foreign($column)
                          ->references($foreignColumn)
                          ->on($foreignTable)
                          ->onUpdate($onUpdate)
                          ->onDelete($onDelete);
                };
                \Schema::table($table, $callback);
            }
        } catch (\Exception $ex)
        {
            $this->down();
            throw $ex;
        }
    }

    public function down()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach (array_keys($this->tables) as $name)
        {
            \Schema::dropIfExists($name);
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    protected function createTable($name)
    {
        $that       = $this;
        $callback   = function ($match)
        {
            return strtoupper(ltrim($match[0], '_'));
        };
        $methodName = 'load' . ucfirst(preg_replace_callback('/_[a-z]?/', $callback, preg_replace('/[0-9]*$/', '', $name)));

        $callback            = function (Blueprint $table) use ($that, $methodName)
        {
            $table->engine = 'InnoDB';
            $that->$methodName($table);
        };
        $this->tables[$name] = array(
            'callback' => $callback,
        );
    }

    protected function foreign($column, $foreignTable, $foreignColumn = 'id', $onUpdate = null, $onDelete = null)
    {
        $this->foreignKeys[] = array(
            'table'         => $this->actualTableName,
            'column'        => $column,
            'foreignTable'  => $foreignTable,
            'foreignColumn' => $foreignColumn,
            'onUpdate'      => $onUpdate,
            'onDelete'      => $onDelete,
        );
    }
} 