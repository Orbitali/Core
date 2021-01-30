<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW search_view AS
    SELECT
        'website_detail' AS model_type,
        wd.id AS model_id,
        wd.name AS `name`,
        we. `key` AS `key`,
        we. `value` AS `value`,
        wde. `key` AS detail_key,
        wde. `value` AS detail_value,
        wd.`language` as `language`,
        u.website_id AS website_id,
        u.url AS url
    FROM
        websites AS w
        LEFT JOIN website_extras AS we ON we.website_id = w.id
        LEFT JOIN website_details AS wd ON wd.website_id = w.id
        LEFT JOIN website_detail_extras AS wde ON wde.website_detail_id = wd.id
        LEFT JOIN urls AS u ON u.model_id = wd.id AND u.model_type = 'website_detail'
UNION
	SELECT
		'node_details' AS model_type,
		nd.id AS model_id,
		nd.name AS `name`,
		ne. `key` AS `key`,
		ne. `value` AS `value`,
		nde. `key` AS detail_key,
		nde. `value` AS detail_value,
		nd.`language` as `language`,
		u.website_id AS website_id,
		u.url AS url
	FROM
		nodes AS n
	LEFT JOIN node_extras AS ne ON ne.node_id = n.id
	LEFT JOIN node_details AS nd ON nd.node_id = n.id
	LEFT JOIN node_detail_extras AS nde ON nde.node_detail_id = nd.id
	LEFT JOIN urls AS u ON u.model_id = nd.id AND u.model_type = 'node_details'
UNION
	SELECT
		'page_details' AS model_type,
		pd.id AS model_id,
		pd.name AS `name`,
		pe. `key` AS `key`,
		pe. `value` AS `value`,
		pde. `key` AS detail_key,
		pde. `value` AS detail_value,
		pd.`language` as `language`,
		u.website_id AS website_id,
		u.url AS url
	FROM
		pages AS p
	LEFT JOIN page_extras AS pe ON pe.page_id = p.id
	LEFT JOIN page_details AS pd ON pd.page_id = p.id
	LEFT JOIN page_detail_extras AS pde ON pde.page_detail_id = pd.id
	LEFT JOIN urls AS u ON u.model_id = pd.id AND u.model_type = 'page_details'
UNION
	SELECT
		'category_details' AS model_type,
		cd.id AS model_id,
		cd.name AS `name`,
		ce. `key` AS `key`,
		ce. `value` AS `value`,
		cde. `key` AS detail_key,
		cde. `value` AS detail_value,
		cd.`language` as `language`,
		u.website_id AS website_id,
		u.url AS url
	FROM
		categories AS c
	LEFT JOIN category_extras AS ce ON ce.category_id = c.id
	LEFT JOIN category_details AS cd ON cd.category_id = c.id
	LEFT JOIN category_detail_extras AS cde ON cde.category_detail_id = cd.id
	LEFT JOIN urls AS u ON u.model_id = cd.id AND u.model_type = 'category_details'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS search_view");
    }
}
