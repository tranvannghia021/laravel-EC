
const $$ = document.querySelectorAll.bind(document);
/* My Profile */
const submenu_profiles = $$("#submenu-myprofile");
const panes = $$("#panel-info");
console.log(submenu_profiles);
console.log(panes);

submenu_profiles.forEach((tab, index) => {
    const pane = panes[index];
  
    tab.onclick = function () {
      document.querySelector(".tab-item.active").classList.remove("active");
      document.querySelector(".tab-pane.active").classList.remove("active");
  
     
  
      this.classList.add("active");
      pane.classList.add("active");
    };
  });
const order_items = $$(".order-item");
console.log(order_items);
order_items.forEach((item,index)=>{
  item.onclick=()=>{
    let url=item.getAttribute('data-redirect')
    window.location=url

  }
})