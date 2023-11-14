# Disclaimer:

> This is my final project for back-end rookie. It is _currently_ my proudest work among the many things I've made for bit-academy. It has a functional database intergrated by PDO with a login-system using sessions. I have not bothered translated it to English because It is a code showcase, it is not and was not made for day-to-day use.

# Receptbeheer

Welkom bij Receptbeheer! Dit is een webtoepassing waarmee je jouw favoriete recepten kunt opslaan en beheren. Met behulp van deze applicatie kun je recepten toevoegen, bewerken, verwijderen en doorzoeken op basis van categorieën en ingrediënten.

## Installatie

Volg deze stappen om de applicatie op je lokale server te draaien:

1. Zorg ervoor dat je een webserver, zoals Apache, hebt geïnstalleerd op je lokale machine.

2. Download of clone de repository naar je lokale machine.

   ```bash
   git clone git@github.com:FabianvanUnen/Back-End-project-2022-2023.git
   ```

3. Navigeer naar de hoofdmap van de applicatie.

   ```bash
   cd receptbeheer
   ```

4. Als `config.php` nog niet bestaat, maak een nieuw bestand met de naam `config.php` in de `classes`-map.

5. Open het `config.php`-bestand en configureer de databaseverbinding met de volgende code:

   ```php
   <?php
   // Database configuratie
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'recept_beheer');
   define('DB_USER', 'root');
   define('DB_PASSWORD', '');
   ```

   Vervang `DB_USER` en `DB_PASSWORD` door de juiste gegevens voor jouw database.

6. Importeer het bijgeleverde SQL-bestand (`import.sql`) in je database.

7. Start je lokale server en open de applicatie in je webbrowser.

   ```
   localhost/
   ```

## Gebruik

1. Maak een nieuw account aan door te klikken op "Registreren" op de startpagina. Vul je gebruikersnaam en wachtwoord in.

2. Log in met je nieuwe account.

3. Voeg nieuwe recepten toe door te klikken op "Add a new recipe". Vul de titel, ingrediënten en instructies in.

4. Bekijk, bewerk of verwijder je bestaande recepten door te navigeren naar de lijst met recepten.

5. Gebruik de zoekfunctie om recepten te vinden op basis van de categorie.

6. Bekijk je gebruikersprofiel om een overzicht te krijgen van je accountinformatie en de recepten die je hebt toegevoegd.

---
