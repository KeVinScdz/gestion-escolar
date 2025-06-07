<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nueva solicitud de información</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4F46E5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #4F46E5;
        }
        .message {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #eee;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nueva solicitud de información</h1>
    </div>
    
    <div class="content">
        <div class="field">
            <span class="label">Nombre completo:</span>
            <p>{{ $fullName }}</p>
        </div>

        <div class="field">
            <span class="label">Correo electrónico:</span>
            <p>{{ $email }}</p>
        </div>

        <div class="field">
            <span class="label">Teléfono:</span>
            <p>{{ $phone }}</p>
        </div>

        <div class="field">
            <span class="label">Institución:</span>
            <p>{{ $institution }}</p>
        </div>

        <div class="field">
            <span class="label">Rol:</span>
            <p>{{ $role }}</p>
        </div>

        <div class="message">
            <span class="label">Mensaje:</span>
            <p>{{ $emailMessage }}</p>
        </div>
    </div>
</body>
</html>
