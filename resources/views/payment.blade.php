<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .paypal-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .paypal-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .paypal-logo img {
            width: 150px;
        }

        .payment-details {
            margin-bottom: 20px;
        }

        .payment-details label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .payment-details input[type="text"],
        .payment-details input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .payment-details input[type="text"]:focus,
        .payment-details input[type="number"]:focus {
            border-color: #0070ba;
            outline: none;
        }

        .pay-button {
            background-color: #0070ba;
            color: #fff;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        .pay-button:hover {
            background-color: #005c99;
        }

        .terms {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 15px;
        }

        .terms a {
            color: #0070ba;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="paypal-container">
        <div class="paypal-logo">
            <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg" alt="PayPal Logo">
        </div>

        <div class="payment-details">
            <label for="amount">Amount</label>
            <input type="number" id="amount" placeholder="Enter Amount">

            <label for="name">Name</label>
            <input type="text" id="name" placeholder="Enter Your Name">
        </div>

        <button class="pay-button">Pay with PayPal</button>

        <div class="terms">
            By clicking "Pay with PayPal", you agree to our 
            <a href="#">terms and conditions</a>.
        </div>
    </div>
</body>
</html>
