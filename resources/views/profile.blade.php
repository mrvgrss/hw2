<html>
    <head>
        <title>Profile</title>
        <meta name="viewport"
        content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/profile.css') }}">

    </head>
    <body>
        <div id="profileinfo" class="moduleinfo">
            <div id="headerinfo">
                <span>
                    My Account
                </span>
                <span>
                    {{ $info->email }}
                </span>
            </div>
            <div id="detailsinfo">
                <form>
                    <label>First name:</label>
                    <input type="text" placeholder="First name" value="{{ $info->name }}">
                    <label>Last name:</label>
                    <input type="text" placeholder="Last name" value="{{ $info->surname }}">

                </form>
                <div class="savechange" style="display: none;">
                    <div>
                        <span>Salva le modifiche</span>
                    </div> 
                </div>
            </div>
        </div>
        <div class="moduleinfo">
            <h3>Scrivi recensione</h3>
            <form method="post" action="review">
                @csrf
                <label>Titolo:</label>
                <input type="text" name="title" value="{{ $info->title }}" placeholder="Titolo">
                <label>Commento:</label>
                <input type="text" name="details" value="{{ $info->details }}" placeholder="Commento">
                <label>Stelle:</label>
                <input type="number" name="stars" min="1" max="5" value="{{ $info->stars }}" placeholder="Stelle">
                <input type="submit" value="{{ $info->button }}">
                
            </form>
        </div>
    </body>
</html>