<html>
    <head>
        <style>
            *{
                margin: 0;
                padding: 0;
            }
        </style>
    </head>

    <body>
        <div style="text-align: center; height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #343536; color: white;">
            <div>
                <h1>
                    <?php
                    echo $errorCode;
                    ?>
                </h1>
                <p>
                    <?php
                    echo $headerText;
                    ?>
                </p>
            </div>
        </div>
    </body>
</html>