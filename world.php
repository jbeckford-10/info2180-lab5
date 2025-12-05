<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
} catch (PDOException $e) {
    echo "Error: connection unsuccessful " . $e->getMessage();
    exit();
}

$countrySearch = $_GET['country'] ?? '';
$lookup  = $_GET['lookup'] ?? '';


if ($lookup === "cities") { 
    $query = "SELECT cities.name, cities.district, cities.population 
              FROM cities 
              JOIN countries ON cities.country_code = countries.code 
              WHERE countries.name LIKE :country";
} else { 
    $query = "SELECT name, continent, independence_year, head_of_state 
              FROM countries 
              WHERE name LIKE :country";
}

$stmt = $conn->prepare($query);
$stmt->bindValue(':country', "%$countrySearch%");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
    <tr>
        <?php if ($lookup === "cities"): ?>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
        <?php else: ?>
            <th>Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
        <?php endif; ?>
    </tr>

    <?php foreach ($results as $row): ?>
        <tr>
        <?php foreach ($row as $value): ?>
            <td><?= htmlspecialchars($value) ?></td>
        <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
</body>


