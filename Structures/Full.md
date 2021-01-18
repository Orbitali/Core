```json
[
    {
        ":tag": "FormGroup",
        "type": "checkbox",
        ":data-source": "\\Orbitali\\Foundations\\Datasources\\Categories",
        "name": "testCheckbox",
        "title": "Checkbox"
    },
    {
        ":tag": "DetailPanel",
        ":children": [
            {
                ":tag": "FormGroup",
                "type": "text",
                "name": "firstname",
                "title": "First Name",
                ":rules": ["required", "min:10"]
            },
            {
                ":tag": "FormGroup",
                "type": "text",
                "name": "lastname",
                "title": "Last Name",
                ":rules": ["required", "max:10"]
            },
            {
                ":tag": "FormGroup",
                "type": "email",
                "name": "email",
                "title": "Email",
                ":rules": ["required"]
            }
        ]
    },
    {
        ":tag": "FormGroup",
        "type": "textarea",
        "name": "editor",
        "title": "Editor Test"
    },
    {
        ":tag": "FormGroup",
        "type": "file",
        ":multiple": true,
        "name": "file",
        "title": "File Test"
    },
    {
        ":tag": "Panel",
        ":children": [
            {
                ":tag": "PanelTab",
                "title": "1. Personal",
                ":children": [
                    {
                        ":tag": "FormGroup",
                        "type": "text",
                        "name": "firstname",
                        "title": "First Name",
                        ":rules": ["required", "min:10"]
                    },
                    {
                        ":tag": "FormGroup",
                        "type": "text",
                        "name": "lastname",
                        "title": "Last Name",
                        ":rules": ["required", "max:10"]
                    },
                    {
                        ":tag": "FormGroup",
                        "type": "email",
                        "name": "email",
                        "title": "Email",
                        ":rules": ["required"]
                    }
                ]
            },
            {
                ":tag": "PanelTab",
                "title": "2. Details",
                ":children": [
                    {
                        ":tag": "FormGroup",
                        "type": "textarea",
                        "name": "bio",
                        "title": "Bio",
                        "rows": "7",
                        ":rules": ["required", "min:10"]
                    }
                ]
            },
            {
                ":tag": "PanelTab",
                "title": "3. Extra",
                ":children": [
                    {
                        ":tag": "FormGroup",
                        "type": "text",
                        "name": "location",
                        "title": "Location",
                        ":rules": ["required"]
                    }
                ]
            }
        ]
    },
    {
        ":tag": "FormGroup",
        "type": "radio",
        ":data-source": "\\Orbitali\\Foundations\\Datasources\\Categories",
        "name": "testradio",
        "title": "Radio"
    },
    {
        ":tag": "FormGroup",
        "type": "checkbox",
        ":data-source": "\\Orbitali\\Foundations\\Datasources\\Languages",
        "name": "testcheck",
        "title": "Radio"
    },
    {
        ":tag": "FormGroup",
        "type": "select",
        ":multiple": true,
        ":data-source": { "0": "Test 0", "1": "Test 1", "2": "Test 2" },
        "name": "selectTest",
        "title": "Select Test",
        ":rules": ["required"]
    },
    {
        ":tag": "FormGroup",
        "type": "select",
        ":multiple": true,
        ":data-source": "\\Orbitali\\Foundations\\Datasources\\Languages",
        "name": "selectTest2",
        "title": "Select Test",
        ":rules": ["required"]
    },
    {
        ":tag": "FormGroup",
        "type": "select",
        ":multiple": true,
        ":data-source": "\\Orbitali\\Foundations\\Datasources\\Categories",
        "name": "categories",
        "title": "Categories"
    }
]
```
