# UserRegistration

**Setup**

How to run the User registration using CodeIgniter

1.Download the zip file

2.Extract the file and copy registration folder

3.Paste inside root directory(for xampp xampp/htdocs, for wamp wamp/www, for lamp var/www/html)

4.Open PHPMyAdmin (http://localhost/phpmyadmin)

5.Create a database with name test

6.Import Sql file(users.sql in SQL file folder)

7.Run the script http://localhost/

**Email Verification**

Email verification has been done through the Kickbox.Com please check the docs for the same on 
https://github.com/kickboxio/kickbox-php

**Google recaptcha is used as per the documentations avaiable**

Use the repective client secrets in **register.php** in both views and models


**Working**
/register -- default root for registering an user
/welcome -- listing of all the users in the database with sortings used by bootstrap + jquery datatables

# REST API
## Get list of Users

### Request

`GET apiv1/list_all_users`

    http://localhost/apiv1/list_all_users/
### Response
  [{"id":"1","user_name":"test_user","email_id":"test@gmai.com"},{"id":"2","user_name":"test_user","email_id":"test@gmail.com"}]

## Get Specific User by id

### Request
`GET apiv1/list_user_by_id?user_id=#`
    `http://localhost/apiv1/list_user_by_id?user_id=1`
### Response
[{"id":"1","user_name":"test_user","email_id":"test@gmai.com"}]

### Create User

### Request
`POST apiv1/create_user`
 request_body : {"user_name": "","email_id" : "","password":""}
    `http://localhost/apiv1/create_user`
### Response
A text message saying user created successfully

### Update User

### Request
`POST apiv1/update_user`
 request_body : {"id": "","email/password/user_name" : ""}
    `http://localhost/apiv1/update_user`
### Response
A text message saying user updated successfully

### Delete User

### Request
`POST apiv1/delete_user`
 request_body : {"id": ""}
    `http://localhost/apiv1/delete_user`
### Response
A text message saying user deleted successfully

**Test Cases**
`register/unit_test_cases`
