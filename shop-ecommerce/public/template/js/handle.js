
function searchProduct(data) {
    var array=obj_product.filter(o =>o.group_id==data);
  if(array.length>0){
    var htmls=array.map(o =>{
      return `<option value="${o.id}">${o.name}</option>`;
    });
    
  var strs= htmls.join('');
  product.innerHTML=strs;
  }else{
    var htmls=`<option >không có sản phẩm</option>`;

  product.innerHTML=htmls;
  }

}