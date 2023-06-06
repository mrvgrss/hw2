<html>
    <head>
        <title>hw1</title>
        <meta charset="UTF-8"> <!-- Solve XAMP issue with some characters-->
        <meta name="userLoggedIn" content="{{ session()->has('user_id') ? 'true' : 'false' }}"> <!-- Store information about the user's login status and then use JavaScript to show/hide elements based on that status !-->
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/hw2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/media.css') }}">
        <meta name="viewport"
        content="width=device-width, initial-scale=1">
        <script src="{{ URL::to('script/hw2.js') }}" defer></script>
        <script src="{{ URL::to('script/menu.js') }}" defer></script>
    </head>
    <body>
        <div id="menufixed">
            <nav>
                <div class="title-style">
                    <span>VIAGGIAREIT</span>
                </div>
                <div id="menu-container">
                    <a href="#destinazioni">Destinazioni</a>
                    <a href="#offerte">Offerte</a>
                    <a href="#voli">Voli</a>
                    <a href="#pacchetti_vacanze">Pacchetti vacanze</a>
                    <a href="#hotel">Hotel</a>
                <!--   <a href="#blog">Blog</a> -->
                </div>
                <div id="user-info">
                    @if(session()->has('user_id'))
                        <div id="logged-in">
                            <img src="{{ URL::to('media/profile_circle.png') }}">
                            <span>{{ session('name') }}</span>
                        </div>
                    @else
                        <a href="{{ URL::to('register') }}">Registrati Ora</a>
                    @endif
                </div>
                <div id="menu-icon">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>            
            </nav>
        </div>
        <div id="menu">
            <div id="logged-id-menu-buttons">
                <div>
                    <span><a href="profile">Il mio account</a></span>
                </div>
                <div>
                    <span><a href="mybookings">Le mie prenotazioni</a></span>
                </div>
            </div>
            <div id="logout">
                <span><a href="logout">LOG OUT</a></span>
            </div>
        </div>
        <header class="background-fixed">
            <div id="overlay">
            </div>
            <div class="titles-container">
                <h1 class="title-style">VIAGGIAREIT</h1>
                <h2 class="sub-title-style">La tua destinazione perfetta</h2>
            </div>

        </header>
        <section id="search-container">
            <div id="search-input">
                <div>
                    <div id="select-form">
                        <div class="select-form-item active">
                            <img src="./media/flight.png">
                            <span>Voli</span>
                        </div>
                        <div class="select-form-item">
                            <img src="./media/hotel.png">
                            <span>Hotel</span>
                        </div>
                        <div class="select-form-item">
                            <img src="./media/sport.png">
                            <span>Attività</span>
                        </div>
                    </div>
                    <div id="form-container">
                        <form id="flight-form">
                            <span>Partenza da:</span>
                            <input type="text" class="search-box origin_location" id="flight-origin" placeholder="Viaggia da" value="ROM">
                            <span>Arrivo a:</span>
                            <input type="text" class="search-box destination_location" id="flight-destination" placeholder="Viaggia a " value="MEX">
                            <span>Adulti:</span>
                            <input type="number" class="adults-number" id="flight-adults" placeholder="Numero adulti" min="1" max="5" value="1">
                            <span>Data di partenza:</span>
                            <input type="date" id="flight-departure-date" class="input-departure-date">
                            <span>Data di ritorno:</span>
                            <input type="date" id="flight-return-date" class="input-return-date">
                            <input type="submit">
                        </form>
                    </div>
                </div>
            </div>
            <div id="loading-cotainer">
                <span>Ricerca...</span>
            </div>
            <div id="results-container">
                <div id="flight-offert">
                    <div class="flight-offert-item" id="flight-offert-1">
                        <div class="header-flight-offert-item">
                            <span class="title">
                                Offerta n. 
                                <span class="id-offer">1</span>
                            </span>
                        </div>
                        <div class="flight-offert-info">
                            <div class="flight-offert-info-company">
                                AIRWAYS
                            </div>
                            <div class="flight-offert-info-mid-item">
                                <div>
                                    <p>
                                        <span class="flight-start-hour">10:20</span>
                                        <span class="flight-start-airport">FCO</span>
                                    </p>
                                </div>
                                <div class="flight-offert-info-rappresentation">
                                    <div class="planes">
                                        <img src="./media/airplane_flight.png">
                                    </div>
                                    <div>
                                        <span class="flight-duration">1H 39m</span>
                                        <span class="flight-stopovers">(0 scali)</span>
                                    </div>
                                </div>
                                <div>
                                    <p>
                                        <span class="flight-end-hour">10:20</span>
                                        <span class="flight-end-airport">LIN</span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <div class="price-details">
                                    Prezzo totale:
                                    <span class="price">300</span><span class="price-currency">EURO</span>
                                </div>
                                <div class="price-button" data-offert-id="0">
                                    Acquista ora
                                </div>
                                <div class="expand-details" data-offert-id="0">
                                    <span>Mostra dettagli</span><img src="./media/arrow-up.png">
                                </div>
                            </div>
                        </div>
                        <div class="itineraries">
                            <div class="itinerary departureFlight">
                                <span>Andata</span>
                                <div class="segments">
                                    <div class="segment">
                                        <div class="info-segment">
                                            <span class="title"><span class="at">11 Maggio 2023</span> </span>
                                        </div>
                                        <div class="flight">
                                            <div class="departure"> 
                                                <div class="details">
                                                    <p>
                                                        Partenza alle: 
                                                        <span class="hour">11:30</span>
                                                        <span class="airport">FCO</span>
                                                        Terminale: 
                                                        <span class="terminal">1</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <div class="flight-icon">
                                                    <img src="./media/flight.png" alt="">
                                                </div>
                                                <div class="info">
                                                    <p>
                                                        Volo con 
                                                        <span class="carrier_code">ITA AIRWAYS</span>
                                                         aircraft 
                                                         <span class="aircraft">AIRBUS INDUSTRIE A318</span>
                                                    </p>
                                                    <p>
                                                        Durata tratta: 
                                                        <span class="duration">3H 11 minuti</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="arrival">
                                                <div class="details">
                                                    <p>
                                                        Arrivo alle: 
                                                        <span class="hour">11:30</span>
                                                        <span class="airport">LIN</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary returnFlight">
                                <span>Ritorno</span>
                                <div class="segments">
                                    <div class="segment">
                                        <div class="info-segment">
                                            <span class="title"><span class="at">11 Maggio 2023</span> </span>
                                        </div>
                                        <div class="flight">
                                            <div class="departure"> 
                                                <div class="details">
                                                    <p>
                                                        Partenza alle: 
                                                        <span class="hour">11:30</span>
                                                        <span class="airport">FCO</span>
                                                        Terminale: 
                                                        <span class="terminal">1</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <div class="flight-icon">
                                                    <img src="./media/flight.png" alt="">
                                                </div>
                                                <div class="info">
                                                    <p>
                                                        Volo con 
                                                        <span class="carrier_code">ITA AIRWAYS</span>
                                                         aircraft 
                                                         <span class="aircraft">AIRBUS INDUSTRIE A318</span>
                                                    </p>
                                                    <p>
                                                        Durata tratta: 
                                                        <span class="duration">3H 11 minuti</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="arrival">
                                                <div class="details">
                                                    <p>
                                                        Arrivo alle: 
                                                        <span class="hour">11:30</span>
                                                        <span class="airport">LIN</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main container -->
        <section id="main-container">
            <div class="main-container-item">
                <h3>
                    Supporto Clienti 24/7
                </h3>
                <p>
                    Hai bisogno di aiuto o hai delle domande? Contatta il nostro team di supporto clienti proattivo disponibile 24 ore su 24, 7 giorni su 7 tramite chat dal vivo, email, hotline o sistema di ticket online
                </p>
            </div>
            <div class="main-container-item">
                <h3>
                    Prezzi Competitivi
                </h3>
                <p>
                    Con accesso a tour ed esperienze uniche, ti garantiamo prezzi estremamente competitivi su oltre 410.000 attività in tutto il mondo.
                </p>
            </div>
            <div class="main-container-item">
                <h3>
                    Veri Vantaggi per i Clienti
                </h3>
                <p>
                    Guadagna facilmente e rapidamente premi con i nostri programmi di incentivi, tra cui sconti Smart, Invita, Fedeltà e Rimborso.
                </p>
            </div>
        </section>
        <!-- Destinations -->
        <section id="destinations-section">
            <h1 class="title-section">Scegli la tua destinazione</h1>
            <h3 class="sub-title-section">Esplora le città più popolari</h2>
            <div class="destinations-container">
                <div class="destinations-container-column">
                    <div class="destinations-container-column-item main-destination-box" id="rome-destination-box">
                        <div class="flex-container">
                            <h2>Roma</h2>
                            <h4>Italia</h4>
                            <span class="price">A partire da €120</span>
                            <div class="favourite" data-city-name="Roma"></div>
                        </div>
                    </div>
                    <div class="sub-destination-box">
                        <div class="destinations-container-column-item" id="dublin-destination-box">
                            <div class="flex-container">
                                <h2>Dublino</h2>
                                <h4>Irlanda</h4>
                                <span class="price">A partire da €120</span>
                                <div class="favourite" data-city-name="Dublino"></div>
                            </div>
                        </div>
                        <div class="destinations-container-column-item" id="vienna-destination-box">
                            <div class="flex-container">
                                <h2>Vienna</h2>
                                <h4>Austria</h4>
                                <span class="price">A partire da €120</span>
                                <div class="favourite" data-city-name="Vienna"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="destinations-container-column">
                    <div class="sub-destination-box">
                        <div class="destinations-container-column-item" id="miami-destination-box">
                            <div class="flex-container">
                                <h2>Miami</h2>
                                <h4>Stati Uniti</h4>
                                <span class="price">A partire da €120</span>
                                <div class="favourite" data-city-name="Miami"></div>
                            </div>
                        </div>
                        <div class="destinations-container-column-item" id="newyork-destination-box">
                            <div class="flex-container">
                                <h2>New York</h2>
                                <h4>Stati Uniti</h4>
                                <span class="price">A partire da €120</span>
                                <div class="favourite" data-city-name="NewYork"></div>
                            </div>
                        </div>
                    </div>
                    <div class="destinations-container-column-item main-destination-box" id="naples-destination-box">
                        <div class="flex-container">
                            <h2>Napoli</h2>
                            <h4>Italia</h4>
                            <span class="price">A partire da €120</span>
                            <div class="favourite" data-city-name="Napoli"></div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="sub-title-section">I paesi più visitati</h3>
            <div class="destinations-container">
                <div class="country-box background-fixed" id="vietnam-destination-box">
                    <span>Vietnam</span>
                </div>
                <div class="country-box background-fixed" id="australia-destination-box">
                    <span>Australia</span>
                </div>
                <div class="country-box background-fixed" id="canada-destination-box">
                    <span>Canada</span>
                </div>
                <div class="country-box background-fixed" id="sweden-destination-box">
                    <span>Svezia</span>
                </div>
            </div>
            
        </section>
        <!-- Reviews -->
        <section id="reviews-section">
            <h1 class="title-section">Le opinioni dei nostri clienti</h1>
            <h3 class="sub-title-section">Leggi le esperienze degli utenti che hanno viaggiato con noi e scopri cosa ne pensano</h2>
            <div id="reviews-container">
                <div class="review-item" id="review-1">
                    <div class="review-row-star">
                        <div>
                            <img src="./media/star.png">
                            <img src="./media/star.png">
                            <img src="./media/star.png">
                            <img src="./media/star.png">
                            <img src="./media/star.png">
                        </div>

                        <span>Recensione verificata</span>
                    </div>
                    <div class="review-details">
                        <span class="review-title">Soggiorno perfetto!</span><br>
                        <span class="review-description">Il nostro soggiorno presso l'hotel è stato semplicemente perfetto! Camere spaziose e pulite, personale cortese e disponibile, e una posizione perfetta vicino a tutte le attrazioni principali della città.</span>
                    </div>
                    <div class="review-end">
                        <span class="review-author-date">Marco Rossi, 10 gennaio 2023</span>
                    </div>
                    
                </div>
            </div>
            
        </section>
        <!-- Final details -->
        <section id="final-section">
            <h1 class="title-section">Scegli la tua prossima avventura</h1>
            <h3 class="sub-title-section">Abbiamo tutto ciò di cui hai bisogno per prenotare un viaggio indimenticabile. Cosa aspetti? Inizia subito la tua prossima avventura!</h3>
            <div id="container-final">
                <p>
                    Con il nostro sito di prenotazione, hai accesso a una vasta gamma di opzioni di viaggio, tra cui voli, hotel, pacchetti vacanze e molto altro ancora. Inoltre, offriamo la comodità di pagamenti con carte di credito e debito, per garantirti una transazione sicura e senza problemi.
                    Ma non è solo una questione di praticità: con il nostro sito, puoi prenotare il viaggio dei tuoi sogni, con la sicurezza di un servizio affidabile e professionale. Che tu stia cercando una vacanza rilassante in una località esotica o un'avventura emozionante in una grande città, noi abbiamo tutto ciò di cui hai bisogno per rendere il tuo viaggio indimenticabile.
                </p>
                <div>
                    <a href="#iniziaSubito" id="button-start-now">Inizia Subito</a>
                </div>
            </div>
        </section>
        <footer>
            <div class="flex-container">
                <div class="flex-container-items">
                    <div class="title-style">
                        <span>VIAGGIAREIT</span>
                    </div>
                    <div class="sub-title-style">
                        <span>Carte di credito e di debito accettate.</span>
                    </div>
                    <div class="container-creditcards">
                        <img class="credit-card" src="./media/visa.png">
                        <img class="credit-card" src="./media/mastercard.png">
                        <img class="credit-card" src="./media/american-express.png">
                    </div>
                </div>
                <div class="flex-container-items footer-sub-category">
                    <h3 class="sub-title-style">Viaggiare</h3>
                    <span>Prenotazioni voli</span>
                    <span>Prenotazioni hotel</span>
                    <span>Noleggio auto</span>
                    <span>Offerte last minute</span>
                    <span>Destinazioni popolari</span>
                    <span>Recensioni di viaggiatori</span>
                    <div class="down-arrowhead"><img src="./media/downarrowhead.png"></div>
                </div>
                <div class="flex-container-items footer-sub-category">
                    <h3 class="sub-title-style">Supporto</h3>
                    <span>Domande frequenti</span>
                    <span>Contatti</span>
                    <span>Informazioni sulla società</span>
                    <span>Termini e condizioni</span>
                    <span>Privacy policy</span>
                    <span>Guida all'utilizzo del sito</span>
                    <div class="down-arrowhead"><img src="./media/downarrowhead.png"></div>
                </div>
                <div class="flex-container-items footer-sub-category">
                    <h3 class="sub-title-style">Link Utili</h3>
                    <span>Informazioni sulla società</span>
                    <span>Lavora con noi</span>
                    <span>Guida all'utilizzo del sito</span>
                    <span>Assistenza clienti</span>
                    <span>Blog</span>
                    <span>Social media</span>
                    <div class="down-arrowhead"><img src="./media/downarrowhead.png"></div>
                </div>
                <div class="flex-container-items footer-sub-category">
                    <h3 class="sub-title-style">Community</h3>
                    <span>Instagram</span>
                    <span>Facebook</span>
                    <span>Telegram</span>
                    <span>Area eventi</span>
                    <span>Galleria fotografica</span>
                    <span>Sondaggi e questionari</span>
                    <div class="down-arrowhead"><img src="./media/downarrowhead.png"></div>
                </div>
            </div>
            <div class="lowest-footer">
                <span>2023 - S/|A/|L/|V/|A/|T/|O/|R/|E/| C/|R/|I/|S/|T/|A/|U/|D/|O 1000005568</span>
            </div>
        </footer>
    </body>
</html>