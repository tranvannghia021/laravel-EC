
var sub_nav_item;
var className='menu-is-opening menu-open'

var url=location.href
var links=url.slice(url.indexOf('admin/')+6, url.length)
var elements=document.querySelectorAll('.nav > .nav-item-li')
//get urlname
nav_item=links.slice(0,links.indexOf('/'))
sub_nav_item=links.slice(links.indexOf('/')+1,links.length)

elements.forEach((item)=>{
    let idname=item.getAttribute('id');
    idname=idname.slice(9,idname.length)
    //products
    if(nav_item ==='products' && idname==='products') {
        item.classList.add('menu-is-opening')
        item.classList.add('menu-open')
        //sub menu
        let sub_nav_item_input=document.querySelectorAll('.nav > .nav-item-li #products');      
        sub_nav_item_input.forEach((link_item)=>{
            if(link_item.href.indexOf(sub_nav_item)!==-1 )       link_item.classList.add('active')
        })
    } 
    //group-products
    if(nav_item ==='group-products' && idname==='group-products') {
        item.classList.add('menu-is-opening')
        item.classList.add('menu-open')
        
        //sub menu
        let sub_nav_item_input=document.querySelectorAll('.nav > .nav-item-li #group-products');      
        sub_nav_item_input.forEach((link_item)=>{
            if(link_item.href.indexOf(sub_nav_item)!==-1 )       link_item.classList.add('active')
        })
    } 
 //providers/list
 if(nav_item ==='providers' && idname==='providers') {
    item.classList.add('menu-is-opening')
    item.classList.add('menu-open')
    item.classList.add('active-navbar')
   
} //order/
if(nav_item ==='orders' && idname==='orders') {
   item.classList.add('menu-is-opening')
   item.classList.add('menu-open')
   item.classList.add('active-navbar')
  
}
//rating
if(nav_item ==='ratings' && idname==='ratings') {
    item.classList.add('menu-is-opening')
    item.classList.add('menu-open')
    item.classList.add('active-navbar')
    
   
 }
 //rating
if(nav_item ==='roles' && idname==='roles') {
    item.classList.add('menu-is-opening')
    item.classList.add('menu-open')
    item.classList.add('active-navbar')
    
   
 }
     //discount
     if(nav_item ==='discounts' && idname==='discounts') {
        item.classList.add('menu-is-opening')
        item.classList.add('menu-open')
        //sub menu
        let sub_nav_item_input=document.querySelectorAll('.nav > .nav-item-li #discounts');      
        sub_nav_item_input.forEach((link_item)=>{
            if(link_item.href.indexOf(sub_nav_item)!==-1 )       link_item.classList.add('active')
        })
    } 
    
    //staffs
    if(nav_item ==='staffs' && idname==='staffs') {
        item.classList.add('menu-is-opening')
        item.classList.add('menu-open')
        //sub menu
        let sub_nav_item_input=document.querySelectorAll('.nav > .nav-item-li #staffs');      
        sub_nav_item_input.forEach((link_item)=>{
            if(link_item.href.indexOf(sub_nav_item)!==-1 )       link_item.classList.add('active')
        })
    } 
    //customer
    if(nav_item ==='customers' && idname==='customers') {
        item.classList.add('menu-is-opening')
        item.classList.add('menu-open')
        //sub menu
        let sub_nav_item_input=document.querySelectorAll('.nav > .nav-item-li #customers');      
        sub_nav_item_input.forEach((link_item)=>{
            if(link_item.href.indexOf(sub_nav_item)!==-1 )       link_item.classList.add('active')
        })
    } 
    //customer
    if(nav_item ==='sliders' && idname==='sliders') {
        item.classList.add('menu-is-opening')
        item.classList.add('menu-open')
        //sub menu
        let sub_nav_item_input=document.querySelectorAll('.nav > .nav-item-li #sliders');      
        sub_nav_item_input.forEach((link_item)=>{
            if(link_item.href.indexOf(sub_nav_item)!==-1 )       link_item.classList.add('active')
        })
    } 
    //customer
    if(nav_item ==='customers' && idname==='customers') {
        item.classList.add('menu-is-opening')
        item.classList.add('menu-open')
        //sub menu
        let sub_nav_item_input=document.querySelectorAll('.nav > .nav-item-li #customers');      
        sub_nav_item_input.forEach((link_item)=>{
            if(link_item.href.indexOf(sub_nav_item)!==-1 )       link_item.classList.add('active')
        })
    } 
     //imports
     if(nav_item ==='imports' && idname==='imports') {
        item.classList.add('menu-is-opening')
        item.classList.add('menu-open')
        //sub menu
        let sub_nav_item_input=document.querySelectorAll('.nav > .nav-item-li #imports');      
        sub_nav_item_input.forEach((link_item)=>{
            if(link_item.href.indexOf(sub_nav_item)!==-1 )       link_item.classList.add('active')
        })
    } 
    
})



// các hàm show phần thử{
const showDetailStaff=(id)=>{
    let input=document.querySelector(`#id-show-detail-staff-${id}`)
    input.style.display='block'
}
const closeDetailStaff=(id)=>{
    let input=document.querySelector(`#id-show-detail-staff-${id}`)
    input.style.display='none'
}