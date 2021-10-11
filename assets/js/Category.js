$(document).ready(function(){
  $('.btn-add').click(function(e){
    
    showParent(0,0);
    $(".modal-title").text("Add new Category");
    $("#name").val("");
    $("#parent").val(0);
    $("#action").val("add");
  })

  $('.category-form').submit(function(e){
    e.preventDefault()
    $.ajax({
      url:'ajax.php?action=add-edit-category',
      method: 'POST',
      data : $(this).serialize(),
      success:function(data){
        if(data){
          $('.form-message').text(data);  
        }
        else{
          location.href = "index.php";
        }
      }
    })
  })

  $('.search_cate').keyup(function(e){
    $(".t-body").empty();
    $.ajax({
      url:'ajax.php?action=search-category',
      method: 'POST',
      data : {search:$(this).val()},
      success:function(data){
        $('.t-body').append(data);

      }
    })
      
    if($(".search_cate").val() == ""){
      index_category();
    }
  })


});
show_list('1');
function show_list(page){
  $.ajax({
    url:'ajax.php?action=pagination&page=' + page,
    method: 'POST',
    success:function(data){
      
      $(".pagination").empty();
      $(".pagination").append(data);
    }
  })
  $.ajax({
    url:'ajax.php?action=list-category&page=' + page,
    method: 'POST',
    success:function(data){
      $(".t-body").empty();
      $(".t-body").append(data);
    }
  })
}

function editCate(id){
  $(".modal-title").text("Edit Category");
  $.ajax({
      url:"ajax.php?action=show_edit",
      method: "POST",
      data : {cate_id:id},
      success:function(data){
        var cate = data.split("/");
        $("#cate_id").val(cate[0]);
        $("#name").val(cate[1]);
        $("#parent").val(cate[2]);
        $("#action").val("edit");
        showParent(cate[0],cate[2]);
      }
    })
};
function deleteCate(id) {
  $.confirm({
      title: "Do you want delete!",
      buttons: {
          confirm : {
              btnClass: "btn-danger" ,
              keys: ["enter", "shift"],
              action : function (e) {
                  $.alert("Confirmed!");
                  $.ajax({
                      url:"ajax.php?action=delete",
                      method: "POST",
                      data : {cate_id:id},
                      success:function(data){
                          //console.log(data);
                          location.reload();
                      }
                  })
              },
          },
          cancel: function () {
              $.alert("Canceled!");
          }
      }
  });
};
function detailCate(id) {
  $.confirm({
      title: "Infomation Category",
      content:function(){
          var self = this;
          self.setContent("Category Name :");
          return $.ajax({
              url: "ajax.php?action=detail",
              data : {cate_id:id},
              method: "POST"
          }).done(function (response) {
              self.setContentAppend(response);
          });
      }
  });
};
function showParent(id,parent_id){
  $('.parent').empty();
  $.ajax({
    url:'ajax.php?action=show-parent&parent-id=' + parent_id +'&cate-id=' + id,
    method: 'POST',
    success:function(data){
      $('.parent').append(data);
    }
  })
}

function copyCate(id,name){
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(name).select();
  document.execCommand("copy");
  $temp.remove();
}