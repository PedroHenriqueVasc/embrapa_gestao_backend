<?php
    session_start();

    $_SESSION['id'] = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script src="jquery-3.5.1.min.js"></script>
    <script>
        function getData(){
            $.ajax({
                url: 'getSession.php?id=1',
                method: 'GET',            
                dataType: 'json',
            }).done(function(res){
                console.log(res)
            })
        }

        getData()
    </script>  
</body>
</html>