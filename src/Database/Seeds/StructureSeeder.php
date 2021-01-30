<?php

namespace Orbitali\Database\Seeds;

use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("structures")->insert([
            [
                "model_type" => "websites",
                "model_id" => 0,
                "mode" => "websites",
                "data" =>
                    '[{":tag":"Status","title":"Durum","name":"status",":rules":["required"]},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"FormGroup","title":"Slug","type":"slug","name":"slug",":rules":["required","regex:\/^[-\\_\\pL\\pM\\pN\\\/]+$\/u","starts_with:$:slug"]},{":tag":"FormGroup","title":"\u0130sim","type":"text","name":"name",":rules":["required","string"]}]},{":tag":"FormGroup","title":"Has SSL","type":"checkbox","name":"ssl",":rules":["checkbox"],":data-source":{"1":"Has SSL ?"}},{":tag":"FormGroup","title":"Domain","type":"text","name":"domain",":rules":["required","unique:websites,domain,@id"]},{":tag":"FormGroup","title":"Diller","type":"select","name":"languages",":rules":["required"],":multiple":true,":data-source":"\\Orbitali\\Foundations\\Datasources\\Languages"}]',
            ],
            [
                "model_type" => "nodes",
                "model_id" => 0,
                "mode" => "nodes",
                "data" =>
                    '[{":tag":"Status",":rules":["required"],"title":"Status"},{":tag":"FormGroup","title":"Type","type":"text","name":"type",":rules":["required","string"]},{":tag":"FormGroup","title":"Single Page","type":"checkbox","name":"single",":rules":["checkbox"],":data-source":{"1":"Single Page"}},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"FormGroup","title":"Slug","type":"slug","name":"slug",":rules":["required_if:single,1"]},{":tag":"FormGroup","title":"Name","type":"text","name":"name",":rules":["required","string"]}]},{":tag":"Script",":content":"jQuery(\'[name=single]\').on(\'change\',({target})=>jQuery(\'[data-slug]\').attr(\'disabled\',!target.checked))"}]',
            ],
            [
                "model_type" => "pages",
                "model_id" => 0,
                "mode" => "pages",
                "data" =>
                    '[{":tag":"Status",":rules":["required"],"title":"Status"},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"FormGroup","title":"Slug","type":"slug","name":"slug",":rules":[]},{":tag":"FormGroup","title":"Name","type":"text","name":"name",":rules":["required"]}]}]',
            ],
            [
                "model_type" => "categories",
                "model_id" => 0,
                "mode" => "categories",
                "data" =>
                    '[{":tag":"Status",":rules":["required"],"title":"Status"},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"FormGroup","title":"Slug","type":"slug","name":"slug",":rules":[]},{":tag":"FormGroup","title":"Name","type":"text","name":"name",":rules":["required"]}]}]',
            ],
        ]);
    }
}
