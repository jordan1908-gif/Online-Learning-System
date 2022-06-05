<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Back Button</title>

    <style>
        #backBtn {
            margin: 0;
            padding: 3px 10px;
            font-family: 'Nunito', sans-serif;
            font-style: normal;
            font-weight: bold;
            line-height: 25px;
            outline: none;
            border: none;
            background-color: #FA8334;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: 0.2s ease-in-out;
            border-radius: 10px;
        }

        #backBtn i {
            margin-right: 10px;
        }

        #backBtn:hover {
            background-color: #FFFFFF;
            color: #FA8334;
            transition: 0.6s;
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