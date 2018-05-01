# Collections
Project for databases course. Live version available at /~mwh9924/Collections/

# Checklist
- [x] **Two Table Join** - Get all games with username of creator for each on website games page:
```sql
SELECT * 
FROM Game 
NATURAL JOIN User
```
*(allGames() function of Models/Game.php)*

- [x] **Three Table Join** - Find the owner of a card by card ID (used for displaying username on cards page):

```sql
SELECT User.userID, Username, RegistrationDate 
FROM User
INNER JOIN Game on Game.UserID = User.userID
INNER JOIN Card on Card.GameID = Game.gameID
WHERE Card.ID = :id
```
*(user() function of Models/Card.php)*
      
- [ ] **Self Join**

- [x] **Aggregate Function** - Counts how many cards are in an individual's collection by a given game ID (used for displaying # cards on games page and user profile):

```sql
SELECT COUNT(GameID)
FROM Card
WHERE Card.GameID = :id
```
*(numCards() function of Models/Game.php)*

- [x] **Aggregate Function using GROUP BY and HAVING** - Card rarity statistics on Cards page.

```sql
SELECT getRarity(Rarity), Count(ID) 
FROM Card 
GROUP BY Rarity 
HAVING Rarity > :minRarity
```
*(rarityCounts() function of Models/Card.php)*

- [x] **Text-based Search Query** - Search for cards by name on website:

```sql
SELECT *
FROM Game
WHERE Name LIKE :searchQuery
```
*(searchGames() function of Models/Game.php)*

- [x] **Stored Function** - Displays tier denotation next to rating on website:

```sql
SELECT tierList(:rating)
```
*(tierDenotation() function of Models/Card.php)*

- [x] **Stored Procedure** - Displays the most recently added card on website:

```sql
CALL getNewest()
```
*(newestCard() function of Models/Card.php)*

- [x] **Trigger** - When adding a new card, the user can choose to include it in one or more decks. The NumOfCards column for each deck will automatically be incremented.

- [x] **Additional Queries**
