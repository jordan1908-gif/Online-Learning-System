<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Document</title>

    <style>
        #backBtn {
            margin: 0;
            padding: 0.195vw 0.65vw;
            font-family: 'Nunito', sans-serif;
            font-style: normal;
            font-weight: bold;
            line-height: 1.628vw;
            outline: none;
            border: none;
            background-color: #FA8474;
            color: #fff;
            font-size: 1.17vw;
            cursor: pointer;
            margin-bottom: 0.65vw;
            transition: 0.2s ease-in-out;
            border-radius: 0.33vw;
        }

        #backBtn i {
            margin-right: 0.33vw;
        }

        #backBtn:hover {
            background-color: #FA8334;
        }
    </style>

</head>
<body>
    <button onclick="goBack()" id="backBtn"><i class="fas fa-caret-left"></i> Back</button>

    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>