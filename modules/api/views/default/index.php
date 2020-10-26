<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf8">
    <title>API</title>
    <link href="https://unpkg.com/swagger-ui-dist@3.36.0/swagger-ui.css" rel="stylesheet">
</head>
<body>
    <div id="swagger-ui"></div>
    <script src="https://unpkg.com/swagger-ui-dist@3/swagger-ui-bundle.js" charset="UTF-8"></script>
    <script>
        SwaggerUIBundle({
            url: '/openapi.json',
            dom_id: '#swagger-ui'
        })
    </script>
</body>
</html>
