IMPORTANTE: Per un corretto funzionamento in modalità offline DEVE essere installato in C:/xampp/htdocs/Covid19Test
D:/xampp/htdocs/Covid19Test

Alcuni metodi per mostrare dei link relativi tagliano la stringa dell'URL dei primi 27 caratteri. (D:/xampp/htdocs/)


1. Installare XAMPP https://www.apachefriends.org/download.html (in C:/xampp o D:/xampp)

2. Avviare da XAMPP servizio Apache e MYSQL

3. Inserire la cartella in C:/xampp/htdocs/

4. Creare un nuovo database da phpmyadmin (http://localhost/phpmyadmin/)

5. Utilizzare le query inserite nel file sqlscripts per generare la struttura del database (in ordine)

6. accedere alla web app da localhost/covid19test

caricheremo in seguito il database da importare con il dataset corretto 
nello sprint 4 sono state aggiunte le funzionalità dell'azienda sanitaria :

l'azienda sanitaria è registrata come account di tipo 0, verrà inserito nel dataset da importare

nel mentre se si vogliono testare le funzionalità, inserire nella tabella utente un account di tipo 0 con i dati desiderati.