<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) ? $_GET['country'] : '';
$country = filter_var($country, FILTER_SANITIZE_STRING);
$lookup =  isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($lookup !== 'cities') {

  $stmt = $conn->query("SELECT * FROM countries where name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

  <table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Continent</th>
            <th>Independence</th>
            <th>Head of State</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?= $row['name']; ?></td>
            <td><?= $row['continent']; ?></td>
            <td><?= $row['independence_year']; ?></td>
            <td><?= $row['head_of_state']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>

<?php
}
else {
    
  $stmt = $conn->query("SELECT cities.name,cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$country%' " );
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <table>
      <thead>
          <tr>
              <th>Name</th>
              <th>District</th>
              <th>Population</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($results as $row): ?>
          <tr>
              <td><?= $row['name']; ?></td>
              <td><?= $row['district']; ?></td>
              <td><?= $row['population']; ?></td>
          </tr>
          <?php endforeach; ?>
      </tbody>
    </table>

<?php
}
?>



