# Collections
Project for databases course. Live version available at /~mwh9924/Collections/

# Checklist
- [x] **Two Table Join** - Get all games with username of creator for each.
```sql
SELECT * 
FROM Game 
NATURAL JOIN User
```
*(line 25 of Models/Game.php)*

- [x] **Three Table Join** - Find the owner of a card by card ID:

```sql
SELECT User.userID, Username, RegistrationDate 
FROM User
INNER JOIN Game on Game.UserID = User.userID
INNER JOIN Card on Card.GameID = Game.gameID
WHERE Card.ID = :id
```
*(line 95 of Models/Card.php)*
      
- [ ] **Self Join**

- [x] **Aggregate Function** - Counts how many cards are in an individual's collection by a given game ID:

```sql
SELECT COUNT(GameID)
FROM Card
WHERE Card.GameID = :id
```
*(line 62 of Models/Game.php)*

- [ ] **Aggregate Function using GROUP BY and HAVING**

```sql
SELECT COUNT(Card.ID)
FROM Card
GROUP BY Card.Rarity
HAVING Card.Rarity = 4
```
*(not yet implemented)*

- [x] **Text-based Search Query** - Search for cards by name:

```sql
SELECT *
FROM Game
WHERE Name LIKE :searchQuery
```
*(line 44 of Models/Game.php)*

- [x] **Stored Function** - Displays tier denotation next to rating on website.

```sql
SELECT tierList(:rating)
```
*(line 125 of Models/Card.php)*

- [x] **Stored Procedure** - Displays the most recently added card on website.

```sql
CALL getNewest()
```
*(line 45 of Models/Card.php)*

- [ ] **Trigger**
