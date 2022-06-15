//group-product ---> 
const chartGroupProduct = document.getElementById("pieChartGroupProduct");
sumGroupProduct = dataGroupProduct.reduce((total, item, index) => {
  return total + item.Tong
}, 0)

numGroupProduct = dataGroupProduct.map((item, index) => {
  return ((item.Tong / sumGroupProduct) * 100).toFixed(2)
})
nameGroupProduct = dataGroupProduct.map((item, index) => {
  return item.name
})
console.log(sumGroupProduct);
const myChartGroupProduct = new Chart(chartGroupProduct, {
  type: "pie",
  data: {
    labels: nameGroupProduct,
    datasets: [
      {
        label: "Tỷ Lệ Mua Hàng Của Các Loại Sản Phẩm",
        data: numGroupProduct,
        backgroundColor: [
          "rgb(255, 99, 132)",
          "rgb(54, 162, 235)",
          "rgb(255, 205, 86)"
        ],
        hoverOffset: 4
      }
    ]
  }
});
// Order-->

var ChartOrder = dataChartOrderLongTime.map((item) => {
  var dateObj = new Date(item.date)
  let year = dateObj.getUTCFullYear()
  let month = dateObj.getUTCMonth() + 1
  let day = dateObj.getDate()
  return {
    date: `${day}-${month}-${year}`,
    value: item.amount_order
  }
})
//console.log(ChartOrder)
//lấy mảng ngày
function checkDate(value){
  let check=0;
  ChartOrder.forEach((item) => {
  // console.log(value)
  if(item.date==value) check=item.value;
})
  return check
}
var daysOfYear = []
var numberChartOrderofDate = []
for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
  let d1 = d.getDate()
  let m1 = d.getMonth() + 1
  let y1 = d.getFullYear()
  daysOfYear.push(`${d1}-${m1}-${y1}`);
  //console.log(checkDate(`${d1}-${m1}-${y1}`))
    if (checkDate(`${d1}-${m1}-${y1}`)) {
      numberChartOrderofDate.push(checkDate(`${d1}-${m1}-${y1}`))
    }
    else numberChartOrderofDate.push(0)


  }

//console.log(dateChartOrder)
const chartStatictisOrder = document.getElementById("areaChartOrder");


const data1 = {
  labels: daysOfYear,
  datasets: [
    {
      label: "Số Đơn Hàng: ",
      backgroundColor: "rgb(255, 99, 132)",
      borderColor: "rgb(255, 99, 132)",
      data: numberChartOrderofDate
    }
  ]
};

const config = {
  type: "line",
  data: data1,
  options: {}
};
const myChart = new Chart(chartStatictisOrder, {
  type: "line",
  data: data1,
  options: {}
});


// Revenues 

const ChartRevenue =dataChartRevenue.map((item) => {
  var dateObj = new Date(item.date)
  let year = dateObj.getUTCFullYear()
  let month = dateObj.getUTCMonth() + 1
  let day = dateObj.getDate()
  return {
    date: `${day}-${month}-${year}`,
    value: item.total_price
  }
})
console.log(ChartRevenue)
//lấy mảng ngày
function checkDateRevenue(value){
  let check=0;
  ChartRevenue.forEach((item) => {
  // console.log(value)
  if(item.date==value) check=item.value;
})
  return check
}
var daysOfYearRevenue = []
var numberChartRevenueofDate = []
for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
  let d1 = d.getDate()
  let m1 = d.getMonth() + 1
  let y1 = d.getFullYear()
  daysOfYearRevenue.push(`${d1}-${m1}-${y1}`);
  //console.log(checkDate(`${d1}-${m1}-${y1}`))
    if (checkDateRevenue(`${d1}-${m1}-${y1}`)) {
      numberChartRevenueofDate.push(checkDateRevenue(`${d1}-${m1}-${y1}`))
    }
    else numberChartRevenueofDate.push(0)


  }

console.log(numberChartRevenueofDate)
const chartStatictisRevenue = document.getElementById("areaChartRevenue");


const myChartRevenue = new Chart(chartStatictisRevenue , {
  type: "line",
  data: {
    labels: daysOfYearRevenue,
    datasets: [
      {
        label: "Doanh Thu: VNĐ",
        backgroundColor: "rgb(55, 99, 132)",
        borderColor: "rgb(255, 99, 132)",
        data: numberChartRevenueofDate
      }
    ]
  },
  options: {}
});