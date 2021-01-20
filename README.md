# Core

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/b81a70153990422f948e4207ec8491f3)](https://app.codacy.com/app/umutakkaya1996/Core?utm_source=github.com&utm_medium=referral&utm_content=Orbitali/Core&utm_campaign=Badge_Grade_Dashboard)

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
