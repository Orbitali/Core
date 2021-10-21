<?php
namespace Orbitali\Foundations\Datasources;
use Orbitali\Http\Models\Menu;

interface IMenuDatasource extends IDatasource
{
    public function source(Menu $menu = null);
}
