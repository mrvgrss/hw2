<html>
    <head>
        <title>Book flight</title>
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/bookflight.css') }}">
        <script src="{{ URL::to('script/bookflight.js') }}" defer></script>
        <meta name="viewport"
        content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>
            Prenota volo
        </h1>
        <div id="resumeOffert">
            <h3>Offerta n: {{ $offer->id }}</h3>
            <div id="infoOffert">
                <div id="dividedInfo">
                    <div>Partenza: <span class="valueInfo">{{ $offer->origin }}</span></div>
                    <div> Destinazione: <span class="valueInfo">{{ $offer->destination }}</span></div>    
                    <div>Data volo di partenza: <span class="valueInfo">{{ $offer->departureDate }}</span></div>
                    <div>Data volo di ritorno: <span class="valueInfo">{{ $offer->returnDate }}</span></div>                   
                </div>
                <div>
                    <div id="priceOffert">
                        <div class="info">
                            <span class="valueInfo">Prezzo di prenotazione</span>
                        </div>
                        <div class="info">
                            <span>Passeggeri <span class="valueInfo">{{ $offer->adults }}x</span></span>
                            
                        </div>
                        <div class="info subtotal">
                            <span>Prezzo base </span>
                            <span class="valueInfo">{{ $offer->base_price }} EUR</span>
                        </div>
                        <div class="info total">
                            <span>Totale</span>
                            <span class="valueInfo">{{ $offer->price }} EUR</span>
                        </div>
                    </div>
                    <div id="bookoffert">
                        <div id="backHome" class="button">
                            <a href="./home.php">Indietro</a>
                        </div>
                        <div id="bookFlightButton" class="button" data-offert-id='{{ $offer->id }}'>
                            <span>Prenota volo</span>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div id="completedBook">
            <h1>Prenotazione completata con successo!</h1>
            <p>
                Eccellente! La tua prenotazione è stata completata con successo. Grazie per aver scelto il nostro servizio di prenotazione online.
                <br>
                Per visualizzare la tua prenotazione, puoi trovare un elenco completo delle tue prenotazioni nella sezione "Le mie prenotazioni" del nostro sito web. Basta cliccare <a href="mybookings.php">qui</a> per andare direttamente alla pagina delle tue prenotazioni.
                <br>
                Ancora grazie per aver scelto il nostro servizio di prenotazione online. Ci auguriamo che tu abbia un ottimo viaggio!
            </p>
        </div>
    </body>
</html>