<?php
/**
 * Created by PhpStorm.
 * User: SAJID
 * Date: 5/20/2017
 * Time: 1:24 PM
 */

include "config/database.php";
include "objects/product.php";
include "objects/category.php";

$page_title = "Read Product";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);
$product_id = isset($_GET['id']) ? $_GET['id'] : die('Error missing id');
$product->id = $product_id;

$stmt = $product->read_one();
include 'header.php';
?>
  <a href="create_product.php" class="btn btn-primary btn-sm float-right">Create
    Product</a>
  <br><br>
  <table class="table">
    <thead>
    <tr>
      <th>Product</th>
      <th>Description</th>
      <th>Price</th>
      <th>Category</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
      <?php extract($row); ?>
      <tr>
        <td><?php echo $name; ?></td>
        <td><?php echo $description; ?></td>
        <td><?php echo '$' . $price; ?></td>
        <td><?php $category->id = $category_id;
          $category->readName();
          echo $category->name;
          ?></td>
        <td>
          <a href="update_product.php?id=<?php echo $id; ?>"
             class="btn btn-warning btn-sm">Update</a>
          <button onclick="delete(<?php echo $id; ?>)"
                  class="btn btn-danger btn-sm">Delete
          </button>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
<?php include "footer.php"; ?>