<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Game Of Life - jm</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="title m-b-md">
                Game Of Life
            </div>
            <div class="buttons">
                <button type="button" id="play" class="btn btn-success">Play</button>
                <button type="button" id="stop" class="btn btn-danger">Stop</button>
                <button type="button" id="next" class="btn btn-primary">Next</button>
                <button type="button" id="clear" class="btn btn-info">Clear</button>

                <h3>Save this generation</h3
                <form method="POST"> 
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <button type="button" id="save" class="btn btn-link">Save</button>
                </form>
            </div>
            <div>
                <h3>Size</h3
                <form method="POST"> 
                    <div class="form-group">
                        <label for="name">Width</label>
                        <input type="text" class="form-control" id="width" value="10" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Height</label>
                        <input type="text" class="form-control" id="height" value="8" required>
                    </div>
                    <button type="button" id="setSize" class="btn btn-link">Set size</button>
                </form>
            </div>
            <table id="matrix" style="height:500px;width:1200px;">
                @for ($x = 0; $x < 8; $x++)
                    <tr>
                    @for ($y = 0; $y < 10; $y++)
                        <td></td>
                    @endfor
                    </tr>
                @endfor
            </table>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
