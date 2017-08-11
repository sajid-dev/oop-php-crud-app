<?php
include_once './config/database.php';
include_once './objects/product.php';
include_once './objects/category.php';

$database = new Database();
$db = $database->getConnection();
$caterory = new Category($db);
$product = new Product($db);
$page_title = "Create Product";
include 'header.php';
$stmt = $caterory->read();
?>
  <br>
  <a href='index.php' class='btn btn-primary float-right'>Read Products</a>
  <br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
      <label for="name" class="form-control-label">Name</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
      <label for="descrip" class="form-control-label">Description</label>
      <input type="text" class="form-control" id="descrip" name="descrip">
    </div>
    <div class="form-group">
      <label for="category" class="form-control-label">Category</label>
      <select name="category" id="category" class="form-control">
        <?php
        echo '<option value="#">Select Category</option>';
        while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($row_category);
          echo "<option value='{$id}'>{$name}</option>";
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="price" class="form-control-label">Price</label>
      <input type="text" class="form-control" id="price" name="price">
    </div>
    <button type="submit" class="btn btn-success">Create</button>
  </form>
<?php
include 'footer.php';

if ($_POST) {

  $product->name = $_POST['name'];
  $product->price = $_POST['price'];
  $product->descripton = $_POST['descrip'];
  $product->categoryId = $_POST['category'];

  if ($product->create()) {
    echo "<div class='alert alert-success'>Product was created.</div>";
  }
  else {
    echo "<div class='alert alert-danger'>Unable to create product.</div>";
  }
}
?>