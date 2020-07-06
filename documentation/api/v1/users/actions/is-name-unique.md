# api/v1/users/actions/is-name-unique
## Checks if name is unique

Post to:
```
api/v1/users/actions/is-name-unique
```
### Request Query Parameters
```json
{
    "name": "User 1"
}
```
* name
    * Type: String
### Response
```json
{
    "name":"User 1",
    "is_unique":true
}
```
* name
    * Type: String
* is_unique
    * Type: String
    * Possible Values: true, false

