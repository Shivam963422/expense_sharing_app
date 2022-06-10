
//--------------------------------STEP1------------------------------------------------------------------//


Clone the project from git using terminal

- open terminal where composer is installed and laravel is setup

- run this command   git clone https://github.com/Shivam963422/expense_sharing_app.git

- 0nce cloned go to the project directory through terminal.


//--------------------------------STEP2------------------------------------------------------------------//


- run this command on terminal   composer install

- run this command   cp .env.example .env (if ubuntu)     // this will create .env file in the project
                     copy .env.example .env (if windows)

-  open project in any editor and goto .env file and connect it with a new  blank database , add credentials
   for database and database name in .env file.

- run this commmand on terminal   php artisan key:generate

- run this command on terminal    php artisan jwt:secret

- run this command on terminal    php artisan migrate

- run this command on terminal    php artisan db:seed  

- run this command on terminal    php artisan serve



//-----------------------------------API DOUMENTATION AND NOTES ------------------------------------------//


Note: By Default due to seeders five users are alredy registered that you can use to login or else you can
      register by your own using the registration api.

Alredy Registered Creds : [email:user1@gmail.com , password: 7257880045],
[email:user2@gmail.com , password: 7257880045] , [email:user3@gmail.com , password: 7257880045] ,
[email:user4@gmail.com , password: 7257880045] , [email:user5@gmail.com , password: 7257880045]

-only registration and login api doesnot need authentication



- Registration Api

Api -  http://127.0.0.1:8000/api/register

Method - POST

curl --location --request POST 'http://127.0.0.1:8000/api/register' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data-raw '{
    "name":"test user",
    "email":"testuser@gmail.com",
    "mobile_number":"7257880086",
    "password":"7257880045",
    "password_confirmation":"7257880045"
}'

Response:  {
    "message": "User successfully registered",
    "user": {
        "name": "test user",
        "email": "testuser@gmail.com",
        "mobile_number": "7257880086",
        "updated_at": "2022-06-09T22:18:49.000000Z",
        "created_at": "2022-06-09T22:18:49.000000Z",
        "id": 7
    }
}


//------------------------------------------------------------------------------------

- Login Api

Api - http://127.0.0.1:8000/api/login

Method - POST

curl --location --request POST 'http://127.0.0.1:8000/api/login' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email":"user1@gmail.com",
    "password":"7257880045"
}'

Response: {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxMzMyNywiZXhwIjoxNjU0ODE2OTI3LCJuYmYiOjE2NTQ4MTMzMjcsImp0aSI6ImZTRjdKdExHTGdRNzhDTGMiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.u6U8ZEe9VIXveVOsReNBSIXOto4Ha4nGQaFwol5bGaA",
    "token_type": "bearer",
    "expires_in": 3600
}

//-----------------------------------------------------------------------------------------

- Logout Api

Api - http://127.0.0.1:8000/api/logout

Method - POST

curl --location --request POST 'http://127.0.0.1:8000/api/logout' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxMzMyNywiZXhwIjoxNjU0ODE2OTI3LCJuYmYiOjE2NTQ4MTMzMjcsImp0aSI6ImZTRjdKdExHTGdRNzhDTGMiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.u6U8ZEe9VIXveVOsReNBSIXOto4Ha4nGQaFwol5bGaA' \
--data-raw '{
    
}'

Response: {
    "message": "User successfully logged out."
}

//-------------------------------------------------------------------------------------------

- Profile Api

Api - http://127.0.0.1:8000/api/profile

Method - POST

curl --location --request POST 'http://127.0.0.1:8000/api/profile' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxMzcwMiwiZXhwIjoxNjU0ODE3MzAyLCJuYmYiOjE2NTQ4MTM3MDIsImp0aSI6IkNUN3Z6T004ek9oN0xublIiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.VHMfqgXV3LUsLcZYGf86dMjVIqkVBu3xfkoleL86xR8' \
--data-raw '{
    
}'

Response: {
    "id": 1,
    "name": "user1",
    "email": "user1@gmail.com",
    "email_verified_at": null,
    "created_at": "2022-06-09T21:49:59.000000Z",
    "updated_at": "2022-06-09T21:49:59.000000Z",
    "mobile_number": "7257880045"
}

//----------------------------------------------------------------------------------------------

- Available Users

Api - http://127.0.0.1:8000/api/available_users

Method - GET

curl --location --request GET 'http://127.0.0.1:8000/api/available_users' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxMzcwMiwiZXhwIjoxNjU0ODE3MzAyLCJuYmYiOjE2NTQ4MTM3MDIsImp0aSI6IkNUN3Z6T004ek9oN0xublIiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.VHMfqgXV3LUsLcZYGf86dMjVIqkVBu3xfkoleL86xR8' \
--data-raw '{
    
}'

Response: {
    "status": 1,
    "message": "Available Users!",
    "data": [
        {
            "userId": 2,
            "name": "user2",
            "email": "user2@gmail.com",
            "mobile_number": "7257880045",
            "created_at": "2022-06-09 21-06-59"
        },
        {
            "userId": 3,
            "name": "user3",
            "email": "user3@gmail.com",
            "mobile_number": "7257880045",
            "created_at": "2022-06-09 21-06-59"
        },
        {
            "userId": 4,
            "name": "user4",
            "email": "user4@gmail.com",
            "mobile_number": "7257880045",
            "created_at": "2022-06-09 21-06-59"
        },
        {
            "userId": 5,
            "name": "user5",
            "email": "user5@gmail.com",
            "mobile_number": "7257880045",
            "created_at": "2022-06-09 21-06-59"
        }
    ]
}


//----------------------------------------------------------------------------------------------

- Create Expense

Api- http://127.0.0.1:8000/api/create_expense

Method - POST

curl --location --request POST 'http://127.0.0.1:8000/api/create_expense' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxMzcwMiwiZXhwIjoxNjU0ODE3MzAyLCJuYmYiOjE2NTQ4MTM3MDIsImp0aSI6IkNUN3Z6T004ek9oN0xublIiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.VHMfqgXV3LUsLcZYGf86dMjVIqkVBu3xfkoleL86xR8' \
--data-raw '{
    "expense_reason":"Hotel Bill",
    "amount":"1000"
}'

Response: {
    "status": 1,
    "message": "Expense Created Sucessfully",
    "data": {
        "expense_reason": "Hotel Bill",
        "amount": "1000.15",
        "created_by": 1,
        "updated_at": "2022-06-09T22:37:46.000000Z",
        "created_at": "2022-06-09T22:37:46.000000Z",
        "id": 1
    }
}

//------------------------------------------------------------------------------------------------

- User Expenses List

Api - http://127.0.0.1:8000/api/list_expenses_created_by_user

Method - GET

curl --location --request GET 'http://127.0.0.1:8000/api/list_expenses_created_by_user' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxMzcwMiwiZXhwIjoxNjU0ODE3MzAyLCJuYmYiOjE2NTQ4MTM3MDIsImp0aSI6IkNUN3Z6T004ek9oN0xublIiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.VHMfqgXV3LUsLcZYGf86dMjVIqkVBu3xfkoleL86xR8' \
--data-raw '{

}'

Response: {
    "status": 1,
    "data": [
        {
            "expenseId": 1,
            "expense_reason": "Hotel Bill",
            "amount": "1000",
            "created_at": "2022-06-09 22:37:46"
        },
        {
            "expenseId": 2,
            "expense_reason": "Electricity Bill",
            "amount": "1500",
            "created_at": "2022-06-09 22:40:37"
        },
        {
            "expenseId": 3,
            "expense_reason": "Maid",
            "amount": "500",
            "created_at": "2022-06-09 22:40:52"
        }
    ]
}

//-------------------------------------------------------------------------------------------------

- Splitting Expenses (Three Types)


- Split-Type 1: EQUAL

Api - http://127.0.0.1:8000/api/split_expenses_to_borrowers

Method - POST

curl --location --request POST 'http://127.0.0.1:8000/api/split_expenses_to_borrowers' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxMzcwMiwiZXhwIjoxNjU0ODE3MzAyLCJuYmYiOjE2NTQ4MTM3MDIsImp0aSI6IkNUN3Z6T004ek9oN0xublIiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.VHMfqgXV3LUsLcZYGf86dMjVIqkVBu3xfkoleL86xR8' \
--data-raw '{
  "split_type":"equal",
  "expense_id":"2",
  "borrower_ids":[4,5]
}'

Response: {
    "status": 1,
    "message": "Split Created Sucessfully"
}

********************************************************************************************

- Split-Type 2: EXACT

Api - http://127.0.0.1:8000/api/split_expenses_to_borrowers

Method - POST

curl --location --request POST 'http://127.0.0.1:8000/api/split_expenses_to_borrowers' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxMzcwMiwiZXhwIjoxNjU0ODE3MzAyLCJuYmYiOjE2NTQ4MTM3MDIsImp0aSI6IkNUN3Z6T004ek9oN0xublIiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.VHMfqgXV3LUsLcZYGf86dMjVIqkVBu3xfkoleL86xR8' \
--data-raw '{
  "split_type":"exact",
  "expense_id":"3",
  "borrower_ids":[4,5],
  "amounts":[350,150]
 
}'

Response: {
    "status": 1,
    "message": "Split Created Sucessfully"
}


********************************************************************************************

- Split-Type 3: PERCENTAGE

Api - http://127.0.0.1:8000/api/split_expenses_to_borrowers

Method - POST

curl --location --request POST 'http://127.0.0.1:8000/api/split_expenses_to_borrowers' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxMzcwMiwiZXhwIjoxNjU0ODE3MzAyLCJuYmYiOjE2NTQ4MTM3MDIsImp0aSI6IkNUN3Z6T004ek9oN0xublIiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.VHMfqgXV3LUsLcZYGf86dMjVIqkVBu3xfkoleL86xR8' \
--data-raw '{
  "split_type":"percentage",
  "expense_id":"1",
  "borrower_ids":[4,5],
  "percentage":[60,20]

 
}'

Response: {
    "status": 1,
    "message": "Split Created Sucessfully"
}

//----------------------------------------------------------------------------------------------

- User Due Sheet

Api - http://127.0.0.1:8000/api/user_due_sheet

Method - GET

curl --location --request GET 'http://127.0.0.1:8000/api/user_due_sheet' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxNjA1NywiZXhwIjoxNjU0ODE5NjU3LCJuYmYiOjE2NTQ4MTYwNTcsImp0aSI6IndyWDdISU1oeURXemNMSUwiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.0Xv8_t2AsEr_r16sgu7lm6RpRG3gn5zXhrwozPCKKe4' \
--data-raw '{
    
}'

Response: {
    "status": 1,
    "data": [
        {
            "due_amount": "260",
            "split_type": "percentage",
            "created_at": "2022-06-09 23:06:16",
            "expense_reason": "Food",
            "paidBy": "user5",
            "email": "user5@gmail.com",
            "mobile_number": "7257880045",
            "paidByUserId": 5
        }
    ]
}

//----------------------------------------------------------------------------------------------

- User Paid Sheet

Api - http://127.0.0.1:8000/api/user_paid_sheet

Method - GET

curl --location --request GET 'http://127.0.0.1:8000/api/user_paid_sheet' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxNjA1NywiZXhwIjoxNjU0ODE5NjU3LCJuYmYiOjE2NTQ4MTYwNTcsImp0aSI6IndyWDdISU1oeURXemNMSUwiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.0Xv8_t2AsEr_r16sgu7lm6RpRG3gn5zXhrwozPCKKe4' \
--data-raw '{
    
}'

Response: {
    "status": 1,
    "data": [
        {
            "due_amount": "150",
            "split_type": "exact",
            "created_at": "2022-06-09 22:58:13",
            "expense_reason": "Shopping",
            "dueUserName": "user5",
            "email": "user5@gmail.com",
            "mobile_number": "7257880045",
            "dueUserId": 5
        },
        {
            "due_amount": "350",
            "split_type": "exact",
            "created_at": "2022-06-09 22:58:13",
            "expense_reason": "Shopping",
            "dueUserName": "user4",
            "email": "user4@gmail.com",
            "mobile_number": "7257880045",
            "dueUserId": 4
        },
        {
            "due_amount": "500.15",
            "split_type": "equal",
            "created_at": "2022-06-09 22:50:18",
            "expense_reason": "Electricity Bill",
            "dueUserName": "user4",
            "email": "user4@gmail.com",
            "mobile_number": "7257880045",
            "dueUserId": 4
        },
        {
            "due_amount": "500",
            "split_type": "equal",
            "created_at": "2022-06-09 22:50:18",
            "expense_reason": "Electricity Bill",
            "dueUserName": "user5",
            "email": "user5@gmail.com",
            "mobile_number": "7257880045",
            "dueUserId": 5
        },
        {
            "due_amount": "600",
            "split_type": "percentage",
            "created_at": "2022-06-09 23:01:28",
            "expense_reason": "Hotel Bill",
            "dueUserName": "user4",
            "email": "user4@gmail.com",
            "mobile_number": "7257880045",
            "dueUserId": 4
        },
        {
            "due_amount": "200",
            "split_type": "percentage",
            "created_at": "2022-06-09 23:01:28",
            "expense_reason": "Hotel Bill",
            "dueUserName": "user5",
            "email": "user5@gmail.com",
            "mobile_number": "7257880045",
            "dueUserId": 5
        }
    ]
}

//-----------------------------------------------------------------------------------------------

Check Balance Respective To User

Api: http://127.0.0.1:8000/api/check_balance_respective_to_user

Method : POST

curl --location --request POST 'http://127.0.0.1:8000/api/check_balance_respective_to_user' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--header 'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDgxNjA1NywiZXhwIjoxNjU0ODE5NjU3LCJuYmYiOjE2NTQ4MTYwNTcsImp0aSI6IndyWDdISU1oeURXemNMSUwiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.0Xv8_t2AsEr_r16sgu7lm6RpRG3gn5zXhrwozPCKKe4' \
--data-raw '{
    "userId":"5"
}'

Response: {
    "status": 1,
    "amount_user_should_pay": 590
}

Note: For this api if the logged in user has paid more then the responce will return with this 
      key name  "amount_user_should_pay": 590
      but
      if logged in user has due then the key name changes to this
      "amount_you_should_pay":167.22

      you can test this api on both conditions.












