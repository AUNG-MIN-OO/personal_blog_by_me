// side bar menu active hover
const menuItem = document.querySelectorAll(".menu-item");
for (let i = 0; i < menuItem.length; i++) {
    menuItem[i].addEventListener('click',function (){
        let currentItem = document.getElementsByClassName('active');
        if (currentItem.length>0){
            currentItem[0].className = currentItem[0].className.replace(' active','');
        }
        this.className += ' active';
    })
}

const sideBar = document.querySelector(".sidebar"),
      showSidebarBtn = document.querySelector(".show-sidebar"),
      hideSidebarBtn = document.querySelector(".hide-sidebar");
showSidebarBtn.addEventListener('click',function (){
    sideBar.classList.add("open-sidebar");
})
hideSidebarBtn.addEventListener('click',function (){
    sideBar.classList.remove("open-sidebar");
})

$(".search-btn").click(function (){
    $(".search-form").fadeIn(1000,function (){
        $(".search-form").toggleClass("show-searchForm")
    })
})

// counter up
$('.counter').counterUp({
    delay: 10,
    time: 1000
});

//chart js
const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
];
const data = {
    labels: labels,
    datasets: [{
        label: 'Monthly viewers',
        backgroundColor: '#2a3042',
        borderColor: '#226089',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
};
const config = {
    type: 'line',
    data,
    options: {}
};

var myChart = new Chart(
document.getElementById('myChart'),
config
);

// ckeditor
$('.summernote').summernote({
    placeholder: 'Hello Bootstrap 4',
    tabsize: 2,
    height: 500,
    toolbar:[

        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],

    ]
});
