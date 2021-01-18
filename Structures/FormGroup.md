```json
[
    {
        ":tag": "FormGroup",
        "type": "text",
        "name": "firstname",
        "title": "First Name",
        ":rules": ["required", "min:10"]
    },
    {
        ":tag": "FormGroup",
        "type": "textarea",
        "name": "lastname",
        "title": "Last Name",
        ":rules": ["required", "max:10"]
    },
    {
        ":tag": "FormGroup",
        "type": "url",
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
    },
    {
        ":tag": "FormGroup",
        "type": "slug",
        ":slug": "/tr/",
        "title": "Slug",
        ":rules": ["required"]
    },
    {
        ":tag": "FormGroup",
        "type": "mask",
        "name": "maskedInp",
        "title": "Masked Input",
        ":mask": "00-00-0000",
        ":lazy": false,
        ":overwrite": false,
        ":placeholderChar": "_",
        ":rules": ["required"]
    },
    {
        ":tag": "FormGroup",
        "type": "file",
        ":multiple": true,
        "name": "file",
        "title": "File Test"
    }
]
```
