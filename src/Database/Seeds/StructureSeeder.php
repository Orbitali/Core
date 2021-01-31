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
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"Status","title":"Status","name":"status",":rules":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Text","type":"text","name":"",":rules":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Editor","type":"editor","name":"",":rules":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Text Area","type":"textarea","name":"",":rules":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Url","type":"url","name":"",":rules":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Email","type":"email","name":"",":rules":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Slug","type":"slug","name":"",":rules":["required","regex:\\/^[-\\\\_\\\\pL\\\\pM\\\\pN\\\\\\/]+$\\/u","starts_with:$:slug","not_in:$:slug"]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Masked Input","type":"mask","name":"",":rules":[],":mask":"",":overwrite":false,":placeholderChar":"_"}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"File","type":"file","name":"",":rules":[],":multiple":false}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Checkbox","type":"checkbox","name":"",":rules":[],":data-source":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Radio Button","type":"radio","name":"",":rules":[],":data-source":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Select","type":"select","name":"",":rules":[],":multiple":false,":data-source":"",":prevent-sort":false}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"Repeater","title":"Repeater",":children":[],":rules":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"DetailPanel","title":"Detail Panel",":children":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" => '{":tag":"Panel","title":"Panel",":children":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"PanelTab","title":"Panel Tab",":children":[]}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" => '{":tag":"Style","title":"Style",":content":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" => '{":tag":"Script","title":"Script",":content":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "test",
                "data" =>
                    '[{":tag":"Status",":rules":["required"],"title":"Status"},{":tag":"Repeater","title":"Repeater",":children":[{":tag":"FormGroup","title":"Text","type":"text","name":"testRep",":rules":[]},{":tag":"Repeater","title":"Repeater",":children":[{":tag":"FormGroup","type":"text","name":"repeater2","title":"Test Repeater Nested",":rules":["required"]}]},{":tag":"FormGroup","title":"File","type":"file",":multiple":true,"name":"filesrepeat",":rules":[]},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"FormGroup","type":"text","title":"Test Repeater","name":"repeater",":rules":["required"]}]}]},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"Repeater","title":"Repeater Detail",":children":[{":tag":"FormGroup","title":"Text","type":"text","name":"repDet",":rules":[]}]},{":tag":"FormGroup","type":"slug","name":"slug","title":"\\u00dcr\\u00fcn Adresi",":rules":["required"]},{":tag":"FormGroup","type":"text","name":"name","title":"Page Name",":rules":["required"]},{":tag":"FormGroup","type":"text","name":"firstname","title":"First Name",":rules":["required","min:10"]},{":tag":"FormGroup","type":"text","name":"lastname","title":"Last Name",":rules":["required","max:10"]},{":tag":"FormGroup","type":"email","name":"email","title":"Email",":rules":["required"]}]},{":tag":"FormGroup","type":"file",":multiple":true,"name":"file","title":"File Test"},{":tag":"FormGroup","type":"textarea","name":"editor","title":"Editor Test"},{":tag":"FormGroup","type":"radio",":data-source":"\\\\Orbitali\\\\Foundations\\\\Datasources\\\\Categories","name":"testradio","title":"Radio"},{":tag":"Panel","title":"Panel",":children":[{":tag":"PanelTab","title":"1. Personal",":children":[{":tag":"FormGroup","type":"text","name":"firstname","title":"First Name",":rules":["required","min:10"]},{":tag":"FormGroup","type":"text","name":"lastname","title":"Last Name",":rules":["required","max:10"]},{":tag":"FormGroup","type":"email","name":"email","title":"Email",":rules":["required"]}]},{":tag":"PanelTab","title":"2. Details",":children":[{":tag":"FormGroup","type":"textarea","name":"bio","title":"Bio","rows":"7",":rules":["required","min:10"]}]},{":tag":"PanelTab","title":"3. Extra",":children":[{":tag":"FormGroup","type":"text","name":"location","title":"Location",":rules":["required"]},{":tag":"FormGroup","type":"select","name":"skills","title":"Skills",":data-source":["Please select your best skill","Photoshop","Html","CSS","Javascript"],":rules":["required","integer","gt:0"]},{":tag":"FormGroup","type":"checkbox","name":"tos","title":"Agree with the terms",":data-source":{"1":"Agree with the terms"},":rules":["checkbox","accepted"]}]}]},{":tag":"FormGroup","type":"select",":multiple":true,":data-source":"\\\\Orbitali\\\\Foundations\\\\Datasources\\\\Languages","name":"selectTest2",":prevent-sort":true,"title":"Select Test",":rules":["required"]},{":tag":"FormGroup","type":"checkbox",":data-source":"\\\\Orbitali\\\\Foundations\\\\Datasources\\\\Languages","name":"testcheck","title":"Radio"},{":tag":"FormGroup","type":"select",":multiple":true,":data-source":["Test 0","Test 1","Test 2"],"name":"selectTest","title":"Select Test",":rules":["required"]},{":tag":"FormGroup","type":"checkbox",":data-source":"\\\\Orbitali\\\\Foundations\\\\Datasources\\\\Categories","name":"testCheckbox","title":"Checkbox"}]',
            ],
        ]);
    }
}
