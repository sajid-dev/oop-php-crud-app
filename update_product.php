<?php
/**
 * Created by PhpStorm.
 * User: SAJID
 * Date: 5/20/2017
 * Time: 1:25 PM
 */

include "config/database.php";
include "objects/product.php";
include "objects/category.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

$product_id = isset($_GET['id']) ? $_GET['id'] : die("Error id not found");

$page_title = "Update Product";
$product->id = $product_id;
$stmt = $product->read_one();

$stmt_cate = $category->read();

include "header.php";
?>
<br>
<a href='index.php' class='btn btn-primary float-right'>Read Products</a>
<br>
<form
  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $product_id; ?>"
  method="post">
  <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
    <?php extract($row); ?>
    <div class="form-group">
      <label for="name" class="form-control-label">Name</label>
      <input type="text" class="form-control" id="name" name="name"
             value="<?php echo $name ?>">
    </div>
    <div class="form-group">
      <label for="descrip" class="form-control-label">Description</label>
      <input type="text" class="form-control" id="descrip" name="descrip"
             value="<?php echo $description ?>">
    </div>
    <div class="form-group">
      <label for="category" class="form-control-label">Category</label>
      <select name="category" id="category" class="form-control">
        <?php
        while ($row_category = $stmt_cate->fetch(PDO::FETCH_ASSOC)) {
          if ($row_category['id'] == $category_id) {
            echo "<option value=" . $row_category['id'] . " selected>";
          }
          else {
            echo "<option value=" . $row_category['id'] . ">";
          }
          echo $row_category['name'] . "</option>";
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="price" class="form-control-label">Price</label>
      <input type="text" class="form-control" id="price" name="price"
             value="<?php echo $price ?>">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
  <?php endwhile; ?>
</form>
<?php
include "footer.php";

if ($_POST) {


  $product->name = $_POST['name'];
  $product->price = $_POST['price'];
  $product->descripton = $_POST['descrip'];
  $product->categoryId = $_POST['category'];
  $product->id = $_GET['id'];

  if ($product->update()) {
    echo "<div class='alert alert-success'>Product was Updated.</div>";
  }
  else {
    echo "<div class='alert alert-danger'>Unable to create product.</div>";
  }
}
?>

