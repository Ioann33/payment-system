### For test starting 
Yuo should execute following command
- **php artisan migrate**
- **php artisan db:seed**
- **php artisan serve**

### Api Endpoint 

POST: /api/payments/{paymentType}

paymentType: OnePay, TwoPay, ThreePay

bodies:
OnePay
{
"transactionId": "9cb3a8a0-1837-1829-9483-704e9013275c",
"userOrderId": "12345",
"amount": "50",
"currency": "USD",
"status": "complete", //статус может быть complete|pending|refunded
"orderCreatedAt": "2020-06-02T00:09:09+00:00",
"orderCompleteAt": "2020-06-02T00:09:53+00:00",
"refundedAmount": "0",
"provisionAmount": "0",
"hash": "5b28c51bb32776e648c94f255ada4cc82212f6b5a785ab37439fcb236a45b03a",
"email": "patrik@gmail.com",
"paymentMethod": "creditcard",
"paymentMethodGroup": "cps",
"isCash": "0",
"sendPush": "1",
"processingTime": "0"
}

TwoPay
{
"identifier": "68a65964-4db8-4a7f-ad26-a97f699d155e",
"orderId": "12346",
"amount": "50",
"currency": "USD",
"state": 2, //состояние может быть 2 - complete, 3 - failed, 4 - pending
"createdAt": 1589936109,
"updatedAt": 1589936121,
"refundedAmount": "0",
"provisionAmount": "0",
"hash": "5b28c51bb32776e648c94f255ada4cc82212f6b5a785ab37439fcb236a45b03a",
"email": "patrik@gmail.com",
"cardMetadata": {
"bin": "551029",
"lastDigits": "3659",
"paymentSystem": "mastercard",
"country": "CA",
"holderName": "Patrik Russel"
}
}

ThreePay
{
"order": "12347",
"txid": "fccc93478b9aec342f620c0c8b82d9ef3a3e8ad73",
"usdAmount": "50",
"status": "completed" // статсус может быть "processing", "completed"
}
