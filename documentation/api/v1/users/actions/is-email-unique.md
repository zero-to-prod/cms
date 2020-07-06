# api/v1/users/actions/is-email-unique
## Checks if email is unique

Post to:
```
api/v1/users/actions/is-email-unique
```
### Request Query Parameters
```json
{
    "email": "user@domain.com"
}
```
* email
    * Type: String
### Response
```json
{
    "email":"dave0016@gmail.com",
    "is_unique":true
}
```
* email
    * Type: String
* is_unique
    * Type: String
    * Possible Values: true, false

