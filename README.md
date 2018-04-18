######### GIFTR API #########
MAD9023 Final Project GIFTR APP Backend - FIRST RESTFUL API using vanilla PHP and SQL

The API contain Three endpoints resources - USERS , PEOPLE , GIFTS

The initial call should be to the Users resource [https://dall0078.edumedia.ca/mad9023/giftr/api/users](https://dall0078.edumedia.ca/mad9023/giftr/api/users). So you generate a token to use for all future calls.

All the calls after that require a token to be passed through the HEADER as **X-Api-Key** parameter.

All the responses from the server will contain AT LEAST a code and a message field. All response codes follow http response codes standard. The message field is for information purposes only.

These all the http response codes the API returns for now:
'HTTP/1.1 200 OK'
'HTTP/1.1 201 Created'
'HTTP/1.1 202 Accepted'
'HTTP/1.1 400 Bad Request'
'HTTP/1.1 401 Unauthorized'
'HTTP/1.1 403 Forbidden'
'HTTP/1.1 404 Not Found'
'HTTP/1.1 405 Method Not Allowed'
'HTTP/1.1 500 Internal Server Error'

```javascript
{"code":200, "message":"User Found"}
```
##### USERS RESOURCE #####
The USERS resource accept POST and GET methods.
[https://dall0078.edumedia.ca/mad9023/giftr/api/users](https://dall0078.edumedia.ca/mad9023/giftr/api/users)
## POST METHOD ## Register a user
To use the Giftr API you must start by calling the users resource with a POST method 
The users resource with POST method requires **device_id** be passed through the request body as FormData.
It will return a JSON object containing a token. 
```javascript
"code": 201,
    "data": {
        "user_id": 113,
        "token": "601234c0dc5a33b2e7f80d84878fa1f676a37d36"
    },
    "message": "User Added"
```
This token must be used for ALL other calls to the server API.
If the **device_id** you are trying to pass is already on the database you will receive as return code: 200 with the old token if it's still valid.

## GET METHOD ## Retrieve a token
If you know you already have registered on the database you can just retrieve your token using the GET method.
It requires **device_id** to be passed as a QUERYSTRING on the url. ex: [https://dall0078.edumedia.ca/mad9023/giftr/api/users?device_id=11111111-1111-1111-1111-111111111111](https://dall0078.edumedia.ca/mad9023/giftr/api/users?device_id=11111111-1111-1111-1111-111111111111)
It will return a JSON object containing a token also as above with code: 200.

##### PEOPLE RESOURCE #####
The PEOPLE resource accept GET , POST , PUT , DELETE methods.
[https://dall0078.edumedia.ca/mad9023/giftr/api/people](https://dall0078.edumedia.ca/mad9023/giftr/api/people)
You must always pass the token in the HEADER as **X-Api-Key** parameter to authenticate and all the parameters are passed as formData on the request body.

## GET METHOD ## Retrieve Person or PeopleList
Two Different responses:
IF you pass a parameter **person_id** on the path ex: [https://dall0078.edumedia.ca/mad9023/giftr/api/people/1](https://dall0078.edumedia.ca/mad9023/giftr/api/people/1) it will return the associated person with the associated ID, with a code:200 if found or code:404 if not found.

IF no parameter is passed it returns the list of people associated with the user session.
It will return a JSON object with an array of people.
```javascript
{
    "code": 200,
    "data": [
        {
            "person_id": 3,
            "user_id": 1,
            "person_dob": "2000-02-02",
            "person_name": "Darth Vader"
        },
        {
            "person_id": 7,
            "user_id": 1,
            "person_dob": "2000-02-02",
            "person_name": "Han Alone"
        }
    ],
    "message": "All people retrieved"
}
```
## POST METHOD ## Add Person
Besides including the normal **X-Api-Key** header ,must also pass both a **person_name** and **person_dob** as parameters on on body request as formData.

The response will be a JSON object containing the newly created person, the code and the message.
```javascript
{
    "code": 201,
    "data": {
        "person_id": "26",
        "person_name": "Obi Wan Kenobi"",
        "person_dob": "2001-02-02"
    },
    "message": "Person Added"
}
```
## DELETE METHOD ## Delete Person
Besides including the normal **X-Api-Key** header ,must also pass both a **person_id** as a path parameter on the URL ex: [https://dall0078.edumedia.ca/mad9023/giftr/api/people/1](https://dall0078.edumedia.ca/mad9023/giftr/api/people/1)

The response will be a JSON object with code, message, and data of person deleted.
```javascript
{
    "code": 200,
    "data": {
        "person_id": "26",
        "person_name": "Obi Wan Kenobi",
        "person_dob": "2001-02-02"
    },
    "message": "Person Deleted"
}
```
## PUT METHOD ## Edit Person
Besides including the normal **X-Api-Key** header ,must also pass both a **person_id** as a path parameter on the URL ex: [https://dall0078.edumedia.ca/mad9023/giftr/api/people/1](https://dall0078.edumedia.ca/mad9023/giftr/api/people/1) and then the parameters you want to edit on the body request as formData. Required parameters are **person_name** **person_dob**

The response will be a JSON object containing the newly created person, the code and the message.
```javascript
{
    "code": 200,
    "data": {
        "person_id": "26",
        "person_name": "Mara Jade",
        "person_dob": "2001-02-02"
    },
    "message": "Person Edited"
}
```

##### GIFTS RESOURCE #####
The GIFTS resource accept GET , POST , PUT , DELETE methods.
[https://dall0078.edumedia.ca/mad9023/giftr/api/gifts](https://dall0078.edumedia.ca/mad9023/giftr/api/gifts)
You must always pass the token in the HEADER as a **X-Api-Key** parameter to authenticate and all the parameters are passed as formData on the request body.

## GET METHOD ## Retrieve Gift, Retrieve all gifts from Person or Retrieve All Persons with gifts from USER session.
Three Different responses:
!!FIRST!! IF you pass a parameter **gift_id** on the path ex: [https://dall0078.edumedia.ca/mad9023/giftr/api/gifts/1123](https://dall0078.edumedia.ca/mad9023/giftr/api/gifts/2311) it will return the gift with the associated ID, with a code:200 if found or code:404 if not found.

!!SECOND!! IF no parameter is passed it returns the list of the Gifts with the people they are associated with from the USER SESSION.
It will return a JSON object with an array of gifts. ORDERED BY PERSON ID.
```javascript
{
    "code": 200,
    "data": [
        {
            "person_id": 10,
            "gift_id": 6,
            "gift_url": "http://polda.com.br",
            "gift_price": "10123.10",
            "gift_store": "Amazon123123"
        },
        {
            "person_id": 10,
            "gift_id": 7,
            "gift_url": "http://polda.com.br",
            "gift_price": "10123.10",
            "gift_store": "Amazon123123"
        },
        {
            "person_id": 10,
            "gift_id": 8,
            "gift_url": "http://polda.com.br",
            "gift_price": "10123.10",
            "gift_store": "Amazon123123"
        },
        {
            "person_id": 10,
            "gift_id": 9,
            "gift_url": "http://polda.com.br",
            "gift_price": "10123.10",
            "gift_store": "Amazon123123"
        }
    ],
    "message": "All gifts retrieved"
}
```

!!THIRD!! If you pass a **person_id** as a QUERY STRING on the URL using the GET method ex:[https://dall0078.edumedia.ca/mad9023/giftr/api/gifts?person_id=77](https://dall0078.edumedia.ca/mad9023/giftr/api/gifts?person_id=77)
It will return a JSON object containing a all the gifts associated with that PERSON also as above with code: 200, if found.
in the same JSON format as the above RESPONSE.

## POST METHOD ## Add Gift
Besides including the normal **X-Api-Key** header , the fields to send are **person_id**, **gift_title**,  **gift_url**, **gift_price**, and **gift_store**. as parameters on on body request as formData.

The response will be a JSON object containing the newly created gift, the code and the message.
```javascript
{
    "code": 201,
    "data": {
            "person_id": 10,
            "gift_id": 9,
            "gift_url": "http://polda.com.br",
            "gift_price": "10123.10",
            "gift_store": "Amazon123123"
        },
    "message": "Gift Added"
}
```
## DELETE METHOD ## Delete Gift
Besides including the normal **X-Api-Key** header ,must also pass both a **gift_id** as a path parameter on the URL ex: [https://dall0078.edumedia.ca/mad9023/giftr/api/gifts/1111](https://dall0078.edumedia.ca/mad9023/giftr/api/gifts/1111)

The response will be a JSON object with code, message, data of gift deleted
```javascript
{
    "code": 200,
    "data": {
            "person_id": 10,
            "gift_id": 9,
            "gift_url": "http://polda.com.br",
            "gift_price": "10123.10",
            "gift_store": "Amazon123123"
        },
    "message": "Gift Deleted"
}
```
## PUT METHOD ## Edit Gift
Besides including the normal **X-Api-Key** header ,must also pass both a **gift_id** as a path parameter on the URL ex: [https://dall0078.edumedia.ca/mad9023/giftr/api/gifts/666](https://dall0078.edumedia.ca/mad9023/giftr/api/gifts/666) and then the parameters you want to edit on the body request as formData. Required parameters are are **person_id**, **gift_title**,  **gift_url**, **gift_price**, and **gift_store**.

The response will be a JSON object containing the EDITED GIFT , the code and the message.
```javascript
{{
    "code": 200,
    "data": {
            "person_id": 10,
            "gift_id": 9,
            "gift_url": "http://polda.com.br",
            "gift_price": "10123.10",
            "gift_store": "Amazon123123"
        },
    "message": "Gift Edited"
}
```