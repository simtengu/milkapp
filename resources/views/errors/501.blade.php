<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
    <style>
        body {
            padding: 0px;
            margin: 0px;
        }
       .container {
           width: 100vw;
           height: 100vh;
           display: flex;
           flex-direction: column;
           align-items: center;
           justify-content: center;
           background: linear-gradient(indigo,blueviolet);

       }
       h1 {
           color: white;
           font-weight: bolder;
           font-size: 26px;
           font-family: open sans;
       }
       a {
           background-color: white;
           border: 0px;
           border-radius: 7px;
           color: blueviolet;
           margin-top: 5px;
           text-decoration: none;
            text-transform: capitalize;
           padding: 8px 5px;
       }
       a:hover {
           background-color: whitesmoke;
           color: indigo;
       }
    </style>
</head>
<body>
    <div class="container">
        <h1>something went wrong please try again later</h1>
        <a href="{{ url('/') }}"> go Home</a>
    </div>
</body>
</html>