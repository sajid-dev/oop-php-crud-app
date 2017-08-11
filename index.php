<?php
/**
 * Created by PhpStorm.
 * User: SAJID
 * Date: 5/19/2017
 * Time: 8:46 PM
 */

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 5;
$form_record_num = ($records_per_page * $page) - $records_per_page;

include "./config/database.php";
include "./objects/product.php";
include "./objects/category.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);


$stmt = $product->readAll($form_record_num, $records_per_page);
$res = $stmt->rowCount();

$page_title = "Read Products";
include 'header.php';
?>
<a href="create_product.php" class="btn btn-primary">Create Product</a>
<br>
<br>
<?php if ($res > 0): ?>
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
      <?php extract($row) ?>
      <tr>
        <td><?php echo $name; ?></td>
        <td><?php echo $description; ?></td>
        <td><?php echo '$' . $price; ?></td>
        <td><?php $category->id = $category_id;
          $category->readName();
          echo $category->name;
          ?></td>
        <td>
          <a href="read_one.php?id=<?php echo $id; ?>"
             class="btn btn-sm btn-primary">Read</a>
          <a href="update_product.php?id=<?php echo $id; ?>"
             class="btn btn-warning btn-sm">Update</a>
          <button onclick="delete_rec(<?php echo $id; ?>)"
                  class="btn btn-danger btn-sm">Delete
          </button>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
  <?php
  $page_url = 'index.php?';
  $total_rows = $product->countAll();
  include 'paging.php';
  ?>
<?php else: ?>
  <div class='alert alert-info'>No products found.</div>
<?php endif; ?>
<script>
  function delete_rec(rid) {
    var answer = confirm("Are you sure do you want to delete");
    if (answer) {
      window.location = 'delete.php?id=' + rid;
    }
  }
</script>
<?php
include "footer.php";
?>
