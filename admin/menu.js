function menuopen() {
    if (document.getElementById('menu_open_btn')) {
      document.getElementById('nav').style.left = "0rem";
      document.getElementById('menu_open_btn').style.display='none';
      document.getElementById('menu_close_btn').style.display='block';
    }
  }
  
  function menuclose() {
    if (document.getElementById('menu_close_btn')) {
      document.getElementById('nav').style.left = "-25rem";
      document.getElementById('menu_open_btn').style.display='block';
      document.getElementById('menu_close_btn').style.display='none';
    }
  }