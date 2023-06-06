<html>
    <head>
        <title>login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/authstyle.css') }}">
        <meta name="viewport"
        content="width=device-width, initial-scale=1">       
    </head>
    <body>
        <div id="authlayout">
            <div id="formauthlayout">
                <form name='input_form' method='post'>
                    @csrf
                    <div class="forminput"> <!-- AUTHSTYLE-->
                        <input type='text' name='email' placeholder="Email">
                    </div>
                    <div class="forminput">
                        <input type='password' name='password' placeholder="Password">
                    </div>
                    <div class="forminput">
                        <input type='submit' id="submit" value="Entra">
                    </div>
                </form>
            </div>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <span>Non sei ancora registrato? Clicca <a href="{{ URL::to('register') }}">qui</a></span>
        </div>
    </body>
</html>