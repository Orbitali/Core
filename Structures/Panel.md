```json
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
```
