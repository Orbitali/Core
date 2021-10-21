<?php

namespace Orbitali\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                    '[{":tag":"Status","title":"Durum","name":"status",":rules":["required"],":show-on-list":true,":show-on-list-empty-header":true,":show-on-list-order":0,":show-on-list-prefix":""},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"FormGroup","title":"Slug","type":"slug","name":"slug",":rules":["required","regex:\/^[-\\\\_\\\\pL\\\\pM\\\\pN\\\\\/]+$\/u","starts_with:$:slug"],":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":1,":show-on-list-prefix":"detail."},{":tag":"FormGroup","title":"\u0130sim","type":"text","name":"name",":rules":["required","string"],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":2,":show-on-list-prefix":"detail."}]},{":tag":"FormGroup","title":"Has SSL","type":"checkbox","name":"ssl",":rules":["checkbox"],":data-source":{"1":"Has SSL ?"},":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":3,":show-on-list-prefix":""},{":tag":"FormGroup","title":"Domain","type":"text","name":"domain",":rules":["required","unique:websites,domain,@id"],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":4,":show-on-list-prefix":""},{":tag":"FormGroup","title":"Diller","type":"select","name":"languages",":rules":["required"],":multiple":true,":data-source":"\\\\Orbitali\\\\Foundations\\\\Datasources\\\\Languages",":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":5,":show-on-list-prefix":""}]',
            ],
            [
                "model_type" => "urls",
                "model_id" => 0,
                "mode" => "urls",
                "data" =>
                    '[{":tag":"FormGroup","title":"Slug","type":"slug",":show-on-list-empty-header":false,":show-on-list-prefix":"",":show-on-list-order":"0","name":"url",":show-on-list":true,":rules":["required","regex:\/^[-\\\\_\\\\pL\\\\pM\\\\pN\\\\\/]+$\/u","unique:urls,url,NULL,model_id,type,original,model_type,!@model_type","unique:urls,url,@id,model_id,type,original,model_type,@model_type"]},{":tag":"Column",":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-prefix":"","title":"Title","name":"model.name",":show-on-list-order":"0"},{":tag":"FormGroup","type":"text",":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-prefix":"","title":"Type","name":"type",":show-on-list-order":"0",":rules":["required","in:original,redirect"]}]',
            ],
            [
                "model_type" => "users",
                "model_id" => 0,
                "mode" => "users",
                "data" =>
                    '[{":tag":"Status",":rules":["required"],"title":"Status","name":"status",":show-on-list":true,":show-on-list-empty-header":true,":show-on-list-order":0,":show-on-list-prefix":""},{":tag":"FormGroup","type":"text","title":"Name","name":"name",":rules":["required","string"],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":1,":show-on-list-prefix":""},{":tag":"FormGroup","type":"text","title":"Email","name":"email",":rules":["required","email","unique:users,email,@id"],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":2,":show-on-list-prefix":""},{":tag":"FormGroup","type":"password","title":"Password","name":"password",":rules":["hash:skip-empty"],":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":3,":show-on-list-prefix":""},{":tag":"FormGroup","type":"select",":multiple":false,":prevent-sort":false,"title":"Preferred Language","name":"language",":rules":[],":data-source":"\\\\Orbitali\\\\Foundations\\\\Datasources\\\\Languages",":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":4,":show-on-list-prefix":""},{":tag":"FormGroup","type":"select",":multiple":true,":prevent-sort":false,"title":"Roles","name":"roles",":rules":[],":data-source":"\\\\Orbitali\\\\Foundations\\\\Datasources\\\\Roles",":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":5,":show-on-list-prefix":""}]',
            ],
            [
                "model_type" => "nodes",
                "model_id" => 0,
                "mode" => "nodes",
                "data" =>
                    '[{":tag":"Status",":rules":["required"],"title":"Status","name":"status",":show-on-list":true,":show-on-list-empty-header":true,":show-on-list-order":0,":show-on-list-prefix":""},{":tag":"FormGroup","title":"Type","type":"text","name":"type",":rules":["required","string"],":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":1,":show-on-list-prefix":""},{":tag":"FormGroup","title":"Single Page","type":"checkbox","name":"single",":rules":["checkbox"],":data-source":{"1":"Single Page"},":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":2,":show-on-list-prefix":""},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"FormGroup","title":"Slug","type":"slug","name":"slug",":rules":["required_if:single,1"],":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":3,":show-on-list-prefix":"detail."},{":tag":"FormGroup","title":"Name","type":"text","name":"name",":rules":["required","string"],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":4,":show-on-list-prefix":"detail."}]}]',
            ],
            [
                "model_type" => "pages",
                "model_id" => 0,
                "mode" => "pages",
                "data" =>
                    '[{":tag":"Status",":rules":["required"],"title":"Status","name":"status",":show-on-list":true,":show-on-list-empty-header":true,":show-on-list-order":0,":show-on-list-prefix":""},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"FormGroup","title":"Slug","type":"slug","name":"slug",":rules":[],":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":1,":show-on-list-prefix":"detail."},{":tag":"FormGroup","title":"Name","type":"text","name":"name",":rules":["required"],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":2,":show-on-list-prefix":"detail."}]}]',
            ],
            [
                "model_type" => "categories",
                "model_id" => 0,
                "mode" => "categories",
                "data" =>
                    '[{":tag":"Status",":rules":["required"],"title":"Status","name":"status",":show-on-list":true,":show-on-list-empty-header":true,":show-on-list-order":0,":show-on-list-prefix":""},{":tag":"DetailPanel","title":"Detail Panel",":children":[{":tag":"FormGroup","title":"Slug","type":"slug","name":"slug",":rules":[],":show-on-list":false,":show-on-list-empty-header":true,":show-on-list-order":1,":show-on-list-prefix":"detail."},{":tag":"FormGroup","title":"Name","type":"text","name":"name",":rules":["required"],":show-on-list":true,":show-on-list-empty-header":true,":show-on-list-order":2,":show-on-list-prefix":"detail."}]}]',
            ],
            [
                "model_type" => "forms",
                "model_id" => 0,
                "mode" => "forms",
                "data" =>
                    '[{":tag":"Status",":rules":["required"],"title":"Status","name":"status",":show-on-list":true,":show-on-list-empty-header":true,":show-on-list-order":0,":show-on-list-prefix":""},{":tag":"FormGroup","title":"Key","type":"text","name":"key",":rules":["required"],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":1,":show-on-list-prefix":""}]',
            ],
            [
                "model_type" => "tasks",
                "model_id" => 0,
                "mode" => "tasks",
                "data" =>
                    '[{":tag":"Status","title":"Status","name":"status",":show-on-list":true,":show-on-list-empty-header":true,":show-on-list-prefix":"",":rules":[],":show-on-list-order":"0"},{":tag":"FormGroup","type":"text",":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-prefix":"","title":"Command","name":"command",":rules":["required"],":show-on-list-order":"0"},{":tag":"FormGroup","type":"text",":show-on-list-empty-header":false,":show-on-list-prefix":"","title":"Parameters","name":"parameters",":rules":[],":show-on-list":false,":show-on-list-order":"0"},{":tag":"FormGroup","type":"text",":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-prefix":"","title":"Expression","name":"expression",":rules":["required"],":show-on-list-order":"0"},{":tag":"FormGroup","type":"checkbox",":show-on-list-empty-header":false,":show-on-list-prefix":"","title":"Dont Overlap","name":"dont_overlap",":data-source":null,":show-on-list-order":"0",":rules":["checkbox"],":show-on-list":false},{":tag":"FormGroup","type":"checkbox",":show-on-list-empty-header":false,":show-on-list-prefix":"","title":"Run In Maintenance","name":"run_in_maintenance",":rules":["checkbox"],":data-source":null,":show-on-list":false,":show-on-list-order":"0"},{":tag":"FormGroup","type":"checkbox",":show-on-list-empty-header":false,":show-on-list-prefix":"","title":"Run on One Server","name":"run_on_one_server",":rules":["checkbox"],":data-source":null,":show-on-list":false,":show-on-list-order":"0"},{":tag":"FormGroup","type":"checkbox",":show-on-list-empty-header":false,":show-on-list-prefix":"","title":"Run In Background","name":"run_in_background",":rules":["checkbox"],":data-source":null,":show-on-list":false,":show-on-list-order":"0"}]',
            ],
            [
                "model_type" => "menus",
                "model_id" => 0,
                "mode" => "menus",
                "data" =>
                    "[{\":tag\":\"Status\",\"name\":\"status\",\":rules\":[\"required\"],\":show-on-list-prefix\":\"\",\"title\":\"Status\",\":show-on-list-empty-header\":true,\":show-on-list\":true,\":show-on-list-order\":0},{\":tag\":\"FormGroup\",\"name\":\"website\",\":rules\":[\"required\"],\":multiple\":false,\"title\":\"Websites\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\Websites\",\"type\":\"select\"},{\":tag\":\"FormGroup\",\"name\":\"type\",\":rules\":[\"required\"],\":multiple\":false,\"title\":\"Type\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\MenuTypes\",\"type\":\"select\"},{\":tag\":\"DetailPanel\",\"title\":\"Detail Panel\",\":children\":[{\":tag\":\"FormGroup\",\"name\":\"name\",\":show-on-list-order\":2,\":rules\":[\"required\"],\":show-on-list-prefix\":\"detail.\",\"title\":\"Name\",\":show-on-list-empty-header\":true,\":show-on-list\":true,\"type\":\"text\"}]},{\":tag\":\"FormGroup\",\"name\":\"data\",\":rules\":[],\":multiple\":false,\"title\":\"Route\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\RouteList\",\"type\":\"select\"},{\":tag\":\"FormGroup\",\"name\":\"data\",\":rules\":[],\":multiple\":false,\"title\":\"Data Source\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\MenuDatasources\",\"type\":\"select\"},{\":tag\":\"FormGroup\",\"name\":\"data\",\":rules\":[],\":multiple\":false,\"title\":\"Internal\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\InternalUrls\",\"type\":\"select\"},{\":tag\":\"FormGroup\",\":rules\":[],\":auto-height\":true,\"type\":\"textarea\",\"name\":\"data\",\"title\":\"Javascript\"},{\":tag\":\"FormGroup\",\":rules\":[\"required_unless:type,root\"],\"type\":\"url\",\"name\":\"data\",\"title\":\"Url\"},{\":tag\":\"Script\",\":content\":\"var types = [\\\"route\\\", \\\"datasource\\\", \\\"internal\\\", \\\"javascript\\\", \\\"external\\\"];\\n$(\\\"[name=type]\\\")\\n  .on(\\\"change\\\", function () {\\n    var select = this;\\n    $(\\\".form-group:has([name=data])\\\").map(function (index, element) {\\n      if (types[index] == select.value) {\\n        $(\\\"input,textarea,select\\\", $(element).show()).prop(\\\"disabled\\\", false);\\n      } else {\\n        $(\\\"input,textarea,select\\\", $(element).hide()).prop(\\\"disabled\\\", true);\\n      }\\n    });\\n  })\\n  .change();\",\"title\":\"Script\"}]",
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"Status","title":"Status","name":"status",":rules":[],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Text","type":"text","name":"",":rules":[],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Editor","type":"editor","name":"",":rules":[],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Text Area","type":"textarea","name":"",":rules":[],":auto-height":false,":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Url","type":"url","name":"",":rules":[],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Email","type":"email","name":"",":rules":[],":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Slug","type":"slug","name":"",":rules":["required","regex:\\/^[-\\\\_\\\\pL\\\\pM\\\\pN\\\\\\/]+$\\/u","starts_with:$:slug","not_in:$:slug","unique:urls,url,NULL,model_id,type,original,model_type,!$model_type","unique:urls,url,@id,model_id,type,original,model_type,$model_type"],":show-on-list":false,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Masked Input","type":"mask","name":"",":rules":[],":mask":"",":overwrite":false,":placeholderChar":"_",":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"File","type":"file","name":"",":rules":[],":multiple":false,":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Checkbox","type":"checkbox","name":"",":rules":[],":data-source":"",":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Radio Button","type":"radio","name":"",":rules":[],":data-source":"",":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "structures",
                "model_id" => 0,
                "mode" => "self",
                "data" =>
                    '{":tag":"FormGroup","title":"Select","type":"select","name":"",":rules":[],":multiple":false,":data-source":"",":prevent-sort":false,":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
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
                "mode" => "self",
                "data" =>
                    '{":tag":"Column","title":"Column","name":"",":show-on-list":true,":show-on-list-empty-header":false,":show-on-list-order":0,":show-on-list-prefix":""}',
            ],
            [
                "model_type" => "menus",
                "model_id" => 1,
                "mode" => "self",
                "data" =>
                    "[{\":tag\":\"Status\",\"name\":\"status\",\":rules\":[\"required\"],\":show-on-list-prefix\":\"\",\"title\":\"Status\",\":show-on-list-empty-header\":true,\":show-on-list\":true,\":show-on-list-order\":0},{\":tag\":\"FormGroup\",\"name\":\"icon\",\":rules\":[],\":multiple\":true,\"title\":\"Icon\",\":prevent-sort\":true,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\FontAwesomeIcons\",\"type\":\"select\"},{\":tag\":\"FormGroup\",\"name\":\"website\",\":rules\":[\"required\"],\":multiple\":false,\"title\":\"Websites\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\Websites\",\"type\":\"select\"},{\":tag\":\"FormGroup\",\"name\":\"type\",\":rules\":[\"required\"],\":multiple\":false,\"title\":\"Type\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\MenuTypes\",\"type\":\"select\"},{\":tag\":\"DetailPanel\",\"title\":\"Detail Panel\",\":children\":[{\":tag\":\"FormGroup\",\"name\":\"name\",\":show-on-list-order\":2,\":rules\":[\"required\"],\":show-on-list-prefix\":\"detail.\",\"title\":\"Name\",\":show-on-list-empty-header\":true,\":show-on-list\":true,\"type\":\"text\"}]},{\":tag\":\"FormGroup\",\"name\":\"data\",\":rules\":[],\":multiple\":false,\"title\":\"Route\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\RouteList\",\"type\":\"select\"},{\":tag\":\"FormGroup\",\"name\":\"data\",\":rules\":[],\":multiple\":false,\"title\":\"Data Source\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\MenuDatasources\",\"type\":\"select\"},{\":tag\":\"FormGroup\",\"name\":\"data\",\":rules\":[],\":multiple\":false,\"title\":\"Internal\",\":prevent-sort\":false,\":data-source\":\"Orbitali\\\\Foundations\\\\Datasources\\\\InternalUrls\",\"type\":\"select\"},{\":tag\":\"FormGroup\",\":rules\":[],\":auto-height\":true,\"type\":\"textarea\",\"name\":\"data\",\"title\":\"Javascript\"},{\":tag\":\"FormGroup\",\":rules\":[\"required_unless:type,root\"],\"type\":\"url\",\"name\":\"data\",\"title\":\"Url\"},{\":tag\":\"Script\",\":content\":\"var types = [\\\"route\\\", \\\"datasource\\\", \\\"internal\\\", \\\"javascript\\\", \\\"external\\\"];\\n$(\\\"[name=type]\\\")\\n  .on(\\\"change\\\", function () {\\n    var select = this;\\n    $(\\\".form-group:has([name=data])\\\").map(function (index, element) {\\n      if (types[index] == select.value) {\\n        $(\\\"input,textarea,select\\\", $(element).show()).prop(\\\"disabled\\\", false);\\n      } else {\\n        $(\\\"input,textarea,select\\\", $(element).hide()).prop(\\\"disabled\\\", true);\\n      }\\n    });\\n  })\\n  .change();\",\"title\":\"Script\"}]",
            ],
        ]);
    }
}
