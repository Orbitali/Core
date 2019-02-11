<?php

namespace Orbitali\Foundations;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Traits\Macroable;

class Orbitali
{
    use Macroable;

    public function __wakeup()
    {
        $this->__construct();
    }

    /**
     * Orbitali constructor.
     */
    public function __construct()
    {
        View::share("orbitali", $this);
    }

    public function __destruct()
    {
        //TODO: Cache the mediapress for next request
    }

    public function __get($name)
    {
        if ($this->hasMacro($name) || method_exists(self::class, $name)) {
            $this->$name = $this->$name();
            if (is_a($this->$name, Relation::class)) {
                $relation = $this->$name;
                $this->$name = $this->$name->getResults();
                $relation->getParent()->setRelation($name, $this->$name);
            }
        }
        return $this->$name;
    }

   /* public function __debugInfo()
    {
        //private $Varialbe -> \x00Orbitali\Foundations\Orbitali\x00Varialbe
        //protected $view ->  \0*\0view
        return null;// array_except((array)$this, []);
    }*/
}
