<?php

// Database connection (replace with your details)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get categories for the first dropdown
$sql = "SELECT id, name FROM categories";
$result = mysqli_query($conn, $sql);

// Get products for the second dropdown (initially empty)
$products = [];

if (isset($_GET['category_id'])) {
  $category_id = $_GET['category_id'];
  $sql = "SELECT id, name FROM products WHERE category_id = $category_id";
  $product_result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($product_result)) {
    $products[] = $row;
  }
  mysqli_free_result($product_result);
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Cascading Dropdown Lists</title>
</head>
<body>

<form>
  <select name="category_id" id="category_id" onchange="this.form.submit()">
    <option value="">Select Category</option>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
    <?php endwhile; ?>
    <?php mysqli_free_result($result); ?>
  </select>
  <br><br>
  <select name="product_id" id="product_id">
    <option value="">Select Product</option>
    <?php foreach ($products as $product) : ?>
      <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
    <?php endforeach; ?>
  </select>
</form>

<script>
  // Optional: Add client-side validation to prevent unnecessary form submissions
</script>

</body>
</html>
