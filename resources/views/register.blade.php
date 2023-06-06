<html>
    <head>
        <title>signup</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/authstyle.css') }}">
        <meta name="viewport"
        content="width=device-width, initial-scale=1">
        <script src="{{ URL::to('script/passwordview.js') }}" defer></script>
        <script src="{{ URL::to('script/signup.js')}}" defer></script>
    </head>
    <body>
        <div id="authlayout">
            <div id="formauthlayout">
                <form name='input_form' method='post'>
                    @csrf
                    <div class="rowinput">
                        <div class="forminput">
                            <input type='text' name='name' placeholder="Nome">
                            <span>Nome inserito invalido</span>
                        </div>
                        <div class="forminput">
                            <input type='text' name='surname' placeholder="Cognome">
                            <span>Cognome inserito invalido</span>
                        </div>
                        
                    </div>
                    <div class="forminput">
                        <input type='text' name='email' placeholder="Email">
                        <span>Email inserita non valida</span>
                    </div>
                    <div class="forminput">
                        <div class="passwordview hideicon"></div>
                        <input type='password' name='password' placeholder="Password">
                        <span>Password inserita non valida</span>
                    </div>
                    <div class="forminput">
                        <div class="passwordview hideicon"></div>
                        <input type='password' name='confirmpassword' placeholder="Conferma Password">
                        <span>Password non corrisponde</span>
                    </div>
                    <div class="forminput">
                        <input type='submit' id="submit" value="Registrati">
                        <span>Invio non riuscito</span>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </form>
            </div>
            <span>Hai già un account? Entra <a href="{{ URL::to('login') }}">qui</a></span>
        </div>
    </body>
</html>