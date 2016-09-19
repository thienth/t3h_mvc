<form id="product-form" class="form-horizontal" method="post" action="?ctr=Product&action=SaveProduct">
  <input type="hidden" name="pro_id" value="<?=$product->id?>"/>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pro_name">Product Name:</label>
    <div class="col-sm-10">
      <input autofocus type="text" name="pro_name" class="form-control" id="pro_name" placeholder="Enter Product Name" value="<?=$product->name?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="image">Image:</label>
    <div class="col-sm-10"> 
      <input type="file" class="form-control" name="pro_image" id="image"/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="price">Price:</label>
    <div class="col-sm-10"> 
      <input type="number" min="0" step="0.5" name="pro_price" class="form-control" id="price" value="<?=$product->price?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="price">Category:</label>
    <div class="col-sm-10"> 
      <select class="form-control" name="cate_id" value="<?=$product->cate_id?>">
        <?php
        if($categories){
          foreach ($categories as $key => $value) {
            $selected = $value->cate_id == $product->cate_id ? "selected" : null;
            ?>
              <option <?=$selected?> value="<?=$value->cate_id?>"><?=$value->cate_name?></option>
            <?php
          }
        }
        ?>
      </select>
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Submit</button>
      <button type="reset" class="btn btn-info">Cancel</button>
    </div>
  </div>
</form>
<script type="text/javascript">
  $(document).ready(function(){
    $("#product-form").validate({
      rules:{
        pro_name:{
          required: true,
          minlength: 4,
          maxlength: 10
        }, 
        pro_price:{
          required: true,
          min: 5,
          max: 1000
        }
      },
      messages: {
        pro_name:{
          required: "Ông điền cái gì vào đây cho tôi!!!"
        }
      }
    });
  });
</script>