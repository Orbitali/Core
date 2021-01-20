```json
[
    {
        ":tag": "FormGroup",
        "type": "radio",
        ":data-source": "\\Orbitali\\Foundations\\Datasources\\Categories",
        "name": "testradio",
        "title": "Radio"
    },
    {
        ":tag": "FormGroup",
        "type": "radio",
        ":salt": true,
        ":data-source": [
            { "1": "Active" }, // if order important
            { "0": "Passive" },
            { "2": "Draft" }
        ],
        "name": "status",
        "title": "Status",
        ":rules": ["required"]
    }
]
```
