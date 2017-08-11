<?php
/**
 * Created by PhpStorm.
 * User: SAJID
 * Date: 5/20/2017
 * Time: 1:37 PM
 */


echo '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';
if ($page > 1) {
  echo '<li class="page-item">' . '<a class="page-link" href="' . $page_url . '">First Page</a></li>';
}
$total_pages = ceil($total_rows / $records_per_page);
$range = 2;

$initial_num = $range - $page;
$condition_limit_num = ($page + $range) + 1;


for ($x = $initial_num; $x < $condition_limit_num; $x++) {
  if (($x > 0) && $x <= $total_pages) {
    if ($x == $page) {
      echo "<li class='page-item active'><a class='page-link' href='#'><span class='sr-only'>(current)</span>$x</a></li>";
    }
    else {
      echo "<li class='page-item'><a class='page-link' href='{$page_url}page=$x'>$x</a></li>";
    }
  }
}
if ($page < $total_pages) {
  echo "<li class='page-item'><a class='page-link' href='{$page_url}page=$total_pages'>Last Page</a></li>";
}
echo "</ul></nav>";
?>



