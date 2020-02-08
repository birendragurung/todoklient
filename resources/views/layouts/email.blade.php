<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

</head>
<body>
<table class="body-wrap emailer-body">
    <tr>
        <td class="emailer-container">
            <table>
                <tr>
                    <td align="left" class="masthead">
                        <table class="emailer-header">
                            <tr>
                                <td align="left">

                                </td>
                                <td align="right">
                                    <ul class="list-unstyled">
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="content">
                        @yield('content')
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td class="content footer" align="center">

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
