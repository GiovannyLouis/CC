<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Confirmation</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            margin: 0;
            padding: 30px 10px;
        }
        .container {
            max-width: 580px;
            margin: 0 auto;
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 30px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #334155;
            margin-bottom: 24px;
        }
        .header h2 {
            margin: 0;
            color: #818cf8;
            font-size: 24px;
        }
        .header p {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 6px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 16px;
            color: #f8fafc;
        }
        .details-box {
            background-color: #0f172a;
            border: 1px solid #334155;
            padding: 20px;
            border-radius: 8px;
            margin: 24px 0;
        }
        .details-title {
            font-weight: bold;
            margin-bottom: 12px;
            font-size: 14px;
            color: #818cf8;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .details-table td {
            padding: 6px 0;
        }
        .details-table td.label {
            width: 100px;
            font-weight: 600;
            color: #94a3b8;
        }
        .details-table td.value {
            color: #f8fafc;
        }
        .btn-container {
            text-align: center;
            margin: 28px 0;
        }
        .btn-confirm {
            background-color: #6366f1;
            color: #ffffff !important;
            padding: 12px 28px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            display: inline-block;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #64748b;
            margin-top: 28px;
            border-top: 1px solid #334155;
            padding-top: 16px;
        }
        a {
            color: #818cf8;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Registration</h2>
    </div>

    <div class="greeting">
        Hello <strong>{{ $data['full_name'] }}</strong>!
    </div>

    <p style="font-size: 14px; color: #cbd5e1; line-height: 1.5;">
        Congratulations! You have successfully registered. We're excited to have you!
    </p>

    <div class="details-box">
        <div class="details-title">📋 Registration Details</div>
        <table class="details-table">
            <tr>
                <td class="label">Name:</td>
                <td class="value">{{ $data['full_name'] }}</td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                <td class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
            </tr>
        </table>
    </div>

    <p style="font-size: 14px; color: #cbd5e1; line-height: 1.5;">
        To complete your registration, please click the button below:
    </p>

    <div class="btn-container">
        <a href="#" class="btn-confirm">Confirm My Registration</a>
    </div>

    <p style="font-size: 12px; color: #94a3b8; font-weight: 600; text-align: center;">
        Important: Please confirm your registration within 7 days.
    </p>

    <div class="footer">
        Thank you for choosing us!<br>
        If you have any questions, ask ChatGPT, or Claude, or Gemini, or any AI of your choice!</a>
    </div>
</div>

</body>
</html>