# Recipe Manager
## Omschrijving
De Recepten Beheerder laat gebruikers toe om hun recepten op te slaan en beheren op deze site. Gebruikers kunnen een account aanmaken, er op inloggen en bepaalde gelimiteerd-aan-gebruikers features gebruiken zoals toevoegen, aanpassen en/ of verwijderen van recipes.
## Features:

1. Gebruiker registratie en inloggen
    
    * Gebruikers kunnen een nieuwe account aanmaken door het geven van een gebruikersnaam en wachtwoord.
    * Bestaande gebruikers kunnen inloggen met hun gebruikersnaam en wachtwoord.

2. Recepten beheren

    * Gevalideerde gebruikers kunnen recepten toevoegen als ze: een titel, ingrediënten en instructies meegeven.
    * Gebruikers kunnen een lijst bekijken met bestaande recepten met de opties om het aan te passen of te verwijderen van elk recept.

3. Zoek en Filter

    * Gebruikers kunnen voor recepten zoeken met keywords of ingrediënten.
    * Recepten kunnen gefilterd worden op categorie of kooktijd

4. Categoriën en Tags
    * Gebruikers kunnen categoriën en tags toewijzen aan hun recept voor makkelijke organisatie en zoeken.

5. Gebruiker Profiel
    * Elk gebruiker heeft hen eigen simpele profiel pagina met een overzicht op hun eigen recepten.

## Database Structure

1. User Table
    > Fields: id, username, password
2. Recipe Table:
    > Fields: id, user_id, title, ingredients, instructions, category_id, cooking_time
3. Category Table:
    > Fields: id, name
4. Tag Table:
    > Fields: id, name

## Relationships
* Een gebruiker kan meerdere recepten hebben.
* Een recept kan alleen belangen tot een gebruiker.
* Vele recepten kunnen belangen tot een categorie
* Vele recepten kan meerdere tags bevatten