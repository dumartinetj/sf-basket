$(document).ready(function($){
   $('.removeProductButton').on('click', function(){
       $('.removeProductRef').text($(this).data('product-ref'));
       $('#removeProductConfirmation').attr("href", $('#removeProductConfirmation').data('baseurl')+"/"+$(this).data('product-id'));
   });

   $('.editProductButton').on('click', function(){
       $('#editProductQuantity').val($(this).data('quantity'));
       $('.editProductRef').text($(this).data('product-ref'));
       $('#editProductForm').attr('action', $('#editProductForm').data('baseurl')+"/"+$(this).data('product-id'));
   })
});