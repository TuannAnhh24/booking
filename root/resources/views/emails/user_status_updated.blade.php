<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo cập nhật trạng thái tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #3e389b;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .email-body {
            padding: 20px;
            line-height: 1.6;
        }
        .greeting {
            font-size: 18px;
            color: #333333;
            font-weight: bold;
        }
        .status-message {
            font-size: 16px;
            color: #555555;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777777;
            padding: 20px;
            background-color: #f8f8f8;
        }
        .footer a {
            color: #3e389b;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            background-color: #3e389b;
            color: #ffffff;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
    <div class="email-header">
        {{ __('content.update_status.account_status_update') }}
    </div>
    <div class="email-body">
        <p class="greeting">{{ __('content.update_status.greeting', ['last_name' => $user->last_name, 'first_name' => $user->first_name]) }}</p>
        <p class="status-message">{{ $statusMessage }}</p>
        <p class="status-message">{{ __('content.update_status.status_message') }}</p>
        <a href="#" class="button">{{ __('content.update_status.access_account') }}</a>
    </div>
    <div class="footer">
        <p>{{ __('content.update_status.thank_you') }}</p>
        <p>{{ __('content.update_status.support_team') }}</p>
        <p><a href="#">{{ __('content.update_status.visit_website') }}</a></p>
    </div>
</div>

</body>
</html>
