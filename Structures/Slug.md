```json
{
    ":tag": "FormGroup",
    "type": "slug",
    "name": "Slug",
    "title": "Slug",
    ":rules": [
        "required",
        "regex:/^[-\\_\\pL\\pM\\pN\\/]+$/u",
        "starts_with:$:slug",
        "not_in:$:slug",
        "unique:urls,url,NULL,model_id,type,original,model_type,!$model_type",
        "unique:urls,url,@id,model_id,type,original,model_type,$model_type"
    ]
}
```
