# Testing

To run the tests, please, add a `_files/.credentials.json` file with the following:

```json lines
[
  {
    "user": "valid_estafeta_username",
    // set a valid username
    "password": "valid_estafeta_password",
    // set a valid password
    "account": {
      "name": "valid_account_name",
      "id": "valid_account_id"
    }
  },
  {
    "user": "invalid",
    // set an invalid user
    "password": "invalid"
    // set an invalid password
  },
  {
    "user": "valid_estafeta_username",
    // set a valid user
    "password": "invalid_password"
    // set a invalid password
  }
]
```

