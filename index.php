<!DOCTYPE html>
<html lang="en">
<?php 
include "header.php";
include "admin_class.php";
$crud = new Action;


?>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="#">Product <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link btn btn-primary text-white" href="#">Category</a>
            </li>
          </ul>
        </div>
      </nav>
      <main class="m-2 p-2">
        <div class="form-inline justify-content-center">
          <h3 class="mr-1 text-primary">Search Category: </h3>
          <input class="form-control search_cate" type="search" placeholder="Search" aria-label="Search">
            
        </div>
        <p class="h3"></p>
        <button class="btn btn-lg float-right btn-add" class="btn btn-primary" data-toggle="modal" data-target="#add">
            <i class="fa fa-plus-square-o text-primary " aria-hidden="true"></i>
        </button>
        <div class="container">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Operations</th>
                  </tr>
                </thead>
                 <!-- list category -->
                <tbody class='t-body'>
                  
                </tbody>
              </table>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <!-- list pagination -->
                </ul>
              </nav>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTitle"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="" method="post" class="category-form">
                <div class="modal-body">
                    <h6>Category name</h6>
                    <input type="text" name="name" id="name" class="form-control">
                    <input type="hidden" name="action" id="action" >
                    <input type="hidden" name="cate_id" id="cate_id">
                    <span class="form-message text-danger"></span><hr>
                    <h6>Parent cateory</h6>
                    <select class="form-control parent" name="parent" id="parent" size="4">
                      
                    </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary btn-save" value="Save changes"></input>
                </div>
                </form>
              </div>
            </div>
        </div>
  
      </main>
      <script>
        
      </script>
</body>
</html>