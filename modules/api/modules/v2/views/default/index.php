<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            height: 100%;
            margin: 0;
            width: 100%;
            overflow: hidden;
        }

        #graphiql {
            height: 100vh;
        }
    </style>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/graphiql/graphiql.min.css" />
    <title>GraphQL IDE</title>
</head>

<body>
<div id="graphiql">Loading&hellip;</div>
<script src="https://unpkg.com/graphiql/graphiql.min.js" type="application/javascript"></script>
<script>
    function graphQLFetcher(graphQLParams) {
        return fetch(
            '/api/v2/graphql',
            {
                method: 'post',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(graphQLParams),
                credentials: 'omit',
            },
        ).then(function (response) {
            return response.json().catch(function () {
                return response.text();
            });
        });
    }

    ReactDOM.render(
        React.createElement(GraphiQL, {
            fetcher: graphQLFetcher,
            defaultVariableEditorOpen: true,
        }),
        document.getElementById('graphiql'),
    );
</script>
</body>
</html>
