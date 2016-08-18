// 垂直导航栏
$('#layout-sidebar .menu').navgoco({
  openClass: 'active',
  accordion: true,
  slide: {
    duration: 200,
    easing: 'swing'
  },
  onClickAfter: function(e, submenu) {
    console.log(e);
    $('#layout-sidebar .menu .item').removeClass('active');
    $(e.target).parents('.item').addClass('active');
  }
});


// 导航栏滚动体
$('#layout-sidebar .menu').slimScroll({
  height: '100%'
});

// 配置semantic下拉菜单

$('.ui.selection.dropdown').dropdown();
$('.ui.menu .ui.dropdown').dropdown({
  on: 'hover'
});
