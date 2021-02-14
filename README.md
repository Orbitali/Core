# Core

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/5bf8523812cc47dfaedcfc92229c1a04)](https://www.codacy.com/gh/Orbitali/Core/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Orbitali/Core&amp;utm_campaign=Badge_Grade)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=Orbitali_Core&metric=alert_status)](https://sonarcloud.io/dashboard?id=Orbitali_Core)

<details><summary>Test structure data</summary>

```json
[
    {
        ":tag": "div",
        ":salt": true,
        ":title": "Status",
        "class": "form-group",
        ":children": [
            {
                ":tag": "label",
                "class": "d-block",
                ":content": "Status"
            },
            {
                ":tag": "div",
                "class": "custom-control custom-control-inline custom-radio custom-control-success",
                ":children": [
                    {
                        ":tag": "input",
                        "type": "radio",
                        "id": "active",
                        "name": "status",
                        ":value": "1",
                        "class": "custom-control-input"
                    },
                    {
                        ":tag": "label",
                        "for": "active",
                        ":content": "Active",
                        "class": "custom-control-label"
                    }
                ]
            },
            {
                ":tag": "div",
                "class": "custom-control custom-control-inline custom-radio custom-control-danger",
                ":children": [
                    {
                        ":tag": "input",
                        "type": "radio",
                        "id": "passive",
                        "name": "status",
                        ":value": "0",
                        "class": "custom-control-input"
                    },
                    {
                        ":tag": "label",
                        "for": "passive",
                        ":content": "Passive",
                        "class": "custom-control-label"
                    }
                ]
            },
            {
                ":tag": "div",
                "class": "custom-control custom-control-inline custom-radio custom-control-dark",
                ":children": [
                    {
                        ":tag": "input",
                        "type": "radio",
                        "id": "draft",
                        "name": "status",
                        ":value": "2",
                        "class": "custom-control-input"
                    },
                    {
                        ":tag": "label",
                        "for": "draft",
                        ":content": "Draft",
                        "class": "custom-control-label"
                    }
                ]
            }
        ]
    },
    {
        ":tag": "div",
        ":salt": true,
        ":title": "Order",
        "class": "form-group",
        ":children": [
            {
                ":tag": "label",
                "for": "order",
                ":content": "Order"
            },
            {
                ":tag": "input",
                "type": "number",
                "name": "order",
                "class": "form-control",
                ":rules": ["required", "numeric"]
            }
        ]
    },
    {
        ":tag": "div",
        "class": "js-wizard-simple block block block-rounded block-bordered",
        ":content": "",
        ":children": [
            {
                ":tag": "ul",
                "class": "nav nav-tabs nav-tabs-alt nav-justified",
                "role": "tablist",
                ":content": "",
                ":children": [
                    {
                        ":tag": "li",
                        "class": "nav-item",
                        ":content": "",
                        ":children": [
                            {
                                ":tag": "a",
                                "class": "nav-link active show",
                                "href": "#wizard-simple2-step1",
                                "data-toggle": "tab",
                                ":content": "1. Personal"
                            }
                        ]
                    },
                    {
                        ":tag": "li",
                        "class": "nav-item",
                        ":content": "",
                        ":children": [
                            {
                                ":tag": "a",
                                "class": "nav-link",
                                "href": "#wizard-simple2-step2",
                                "data-toggle": "tab",
                                ":content": "2. Details"
                            }
                        ]
                    },
                    {
                        ":tag": "li",
                        "class": "nav-item",
                        ":content": "",
                        ":children": [
                            {
                                ":tag": "a",
                                "class": "nav-link",
                                "href": "#wizard-simple2-step3",
                                "data-toggle": "tab",
                                ":content": "3. Extra"
                            }
                        ]
                    }
                ]
            },
            {
                ":tag": "div",
                "class": "block-content block-content-full tab-content",
                "style": "min-height: 290px;",
                ":content": "",
                ":children": [
                    {
                        ":tag": "div",
                        "class": "tab-pane active show",
                        "id": "wizard-simple2-step1",
                        "role": "tabpanel",
                        ":content": "",
                        ":children": [
                            {
                                ":tag": "div",
                                "class": "form-group",
                                ":content": "",
                                ":children": [
                                    {
                                        ":tag": "label",
                                        "for": "wizard-simple2-firstname",
                                        ":content": "First Name"
                                    },
                                    {
                                        ":tag": "input",
                                        "class": "form-control form-control-alt",
                                        "type": "text",
                                        "id": "wizard-simple2-firstname",
                                        "name": "firstname"
                                    }
                                ]
                            },
                            {
                                ":tag": "div",
                                "class": "form-group",
                                ":content": "",
                                ":children": [
                                    {
                                        ":tag": "label",
                                        "for": "wizard-simple2-lastname",
                                        ":content": "Last Name"
                                    },
                                    {
                                        ":tag": "input",
                                        "class": "form-control form-control-alt",
                                        "type": "text",
                                        "id": "wizard-simple2-lastname",
                                        "name": "lastname"
                                    }
                                ]
                            },
                            {
                                ":tag": "div",
                                "class": "form-group",
                                ":content": "",
                                ":children": [
                                    {
                                        ":tag": "label",
                                        "for": "wizard-simple2-email",
                                        ":content": "Email"
                                    },
                                    {
                                        ":tag": "input",
                                        "class": "form-control form-control-alt",
                                        "type": "email",
                                        "id": "wizard-simple2-email",
                                        "name": "email"
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        ":tag": "div",
                        "class": "tab-pane",
                        "id": "wizard-simple2-step2",
                        "role": "tabpanel",
                        ":content": "",
                        ":children": [
                            {
                                ":tag": "div",
                                "class": "form-group",
                                ":content": "",
                                ":children": [
                                    {
                                        ":tag": "label",
                                        "for": "wizard-simple2-bio",
                                        ":content": "Bio"
                                    },
                                    {
                                        ":tag": "textarea",
                                        "class": "form-control form-control-alt",
                                        "id": "wizard-simple2-bio",
                                        "name": "bio",
                                        "rows": "7",
                                        ":rules": ["required", "min:10"]
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        ":tag": "div",
                        "class": "tab-pane",
                        "id": "wizard-simple2-step3",
                        "role": "tabpanel",
                        ":content": "",
                        ":children": [
                            {
                                ":tag": "div",
                                "class": "form-group",
                                ":content": "",
                                ":children": [
                                    {
                                        ":tag": "label",
                                        "for": "wizard-simple2-location",
                                        ":content": "Location"
                                    },
                                    {
                                        ":tag": "input",
                                        "class": "form-control form-control-alt",
                                        "type": "text",
                                        "id": "wizard-simple2-location",
                                        "name": "location"
                                    }
                                ]
                            },
                            {
                                ":tag": "div",
                                "class": "form-group",
                                ":content": "",
                                ":children": [
                                    {
                                        ":tag": "label",
                                        "for": "wizard-simple2-skills",
                                        ":content": "Skills"
                                    },
                                    {
                                        ":tag": "select",
                                        "class": "form-control form-control-alt",
                                        "id": "wizard-simple2-skills",
                                        "name": "skills",
                                        ":content": "",
                                        ":children": [
                                            {
                                                ":tag": "option",
                                                "value": "",
                                                ":content": "Please select your best skill"
                                            },
                                            {
                                                ":tag": "option",
                                                "value": "1",
                                                ":value": "1",
                                                ":content": "Photoshop"
                                            },
                                            {
                                                ":tag": "option",
                                                "value": "2",
                                                ":value": "2",
                                                ":content": "HTML"
                                            },
                                            {
                                                ":tag": "option",
                                                "value": "3",
                                                ":value": "3",
                                                ":content": "CSS"
                                            },
                                            {
                                                ":tag": "option",
                                                "value": "4",
                                                ":value": "4",
                                                ":content": "JavaScript"
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                ":tag": "div",
                                "class": "form-group",
                                ":content": "",
                                ":children": [
                                    {
                                        ":tag": "div",
                                        "class": "custom-control custom-checkbox custom-control-primary",
                                        ":content": "",
                                        ":children": [
                                            {
                                                ":tag": "input",
                                                "type": "checkbox",
                                                "class": "custom-control-input",
                                                "id": "wizard-simple2-terms",
                                                "name": "terms",
                                                ":value": "on",
                                                ":rules": ["checkbox"]
                                            },
                                            {
                                                ":tag": "label",
                                                "class": "custom-control-label",
                                                "for": "wizard-simple2-terms",
                                                ":content": "Agree with the terms"
                                            }
                                        ]
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        ]
    }
]
```

</details>

<details><summary>Demo Func</summary>

```js
function bodyParser(d, i, p, r = []) {
    for (i = 0; i < d.length; i++) {
        p = { ":tag": d[i].nodeName.toLowerCase() };
        [].slice.call(d[i].attributes).forEach((t) => (p[t.name] = t.value));
        if (d[i].value) p[":value"] = d[i].value;
        if (d[i].firstChild && d[i].firstChild.nodeType == 3)
            p[":content"] = d[i].firstChild.nodeValue.trim();
        if ((c = bodyParser(d[i].children)).length) p[":children"] = c;
        r.push(p);
    }
    return r;
}
```

</details>

<details><summary>Rols Func</summary>
```php
/*
        use Illuminate\Support\Str;
        use Illuminate\Support\Arr;
        use Illuminate\Support\Facades\Artisan;
        Artisan::call("route:list", ["--json" => true]);
        $routes = json_decode(Artisan::output(), true);
        $routes = collect($routes)
            ->pluck("middleware", "name")
            ->map(function ($m) {
                $mArr = Str::of($m)
                    ->explode("\n")
                    ->filter(function ($s) {
                        return Str::startsWith(
                            $s,
                            "Illuminate\Auth\Middleware\Authorize:"
                        );
                    })
                    ->map(function ($s) {
                        return Str::after(
                            $s,
                            "Illuminate\Auth\Middleware\Authorize:"
                        );
                    });
                return $mArr;
            })
            ->filter(function ($s) {
                return $s->count() > 0;
            });
        dd($routes);
        */
```
</details>

<details><summary>Search view query</summary>
```sql
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
```
</details>
