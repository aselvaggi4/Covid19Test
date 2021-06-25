IMPORTANTE: Per un corretto funzionamento in modalità offline DEVE essere installato in C:/xampp/htdocs/Covid19Test
D:/xampp/htdocs/Covid19Test

Alcuni metodi per mostrare dei link relativi tagliano la stringa dell'URL dei primi 27 caratteri. (D:/xampp/htdocs/covid19test)


1. Installare XAMPP https://www.apachefriends.org/download.html (in C:/xampp o D:/xampp)

2. Avviare da XAMPP servizio Apache e MYSQL

3. Inserire la cartella in C:/xampp/htdocs/

4. Creare un nuovo database da phpmyadmin di nome covid19test (http://localhost/phpmyadmin/)

5.importare dalla sezione "import" il file covid19test.sql

6. accedere alla web app da localhost/covid19test

per visualizzare la dashboard dell'azienda sanitaria:
username --> aziendasanitaria@admin.it
password --> admin
per effettuare il logout navigare di nuovo a localhost/covid19test e premere il tasto per il logout

(Sono stati inseriti tramite dei loop N tamponi per ogni utente registrato, tutti prenotati il 14 giugno; quindi dalla sezione "pazienti positivi" si vedreanno ripetuti i dati degli stessi 10 utenti numerose volte)

NB: Non funzionerà il sistema di invio di email in quanto serve modificare dei file di configurazione di XAMPP aggiungendo email e password da cui inviare le email


1. Inserire il file php.ini in (C:/xampp/php) 
2. Inserire il file sendmail.ini in (C:/xampp/sendmail)