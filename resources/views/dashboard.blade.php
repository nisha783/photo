<!DOCTYPE html>
<html lang="en">

<head>
    <title>Photo Collection</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
  .hero{
  width:100%;
  min-height:100vh;
  background-color:#eceaff;
  color:#525252;
}
  nav{
    background-color:#1a1a1a;
    width:100%;
    padding:10px 10%;
    display:flex;
    align-items:center;
justify-content:space-between;
position:relative;
  }
.logo{
  width:50px;
  border-radius:70%;
  cursor:pointer;
  margin-left:30px;

}
nav ul{
  width:100%;
  text-align:right;

}
nav ul li{
  display:inline-block;
 list-style:none;
}
nav ul li{
color:#fff;
  text-decoration:none;
}
.sub-menu-wrap{
  position:absolute;
  top:100px;
  right:10px;
  max-height:0px;
  width:320px;
  overflow:hidden;
  transition:max-height 0.5s;
}
.sub-menu-wrap.open-menu{
  max-height:400px;
}
.sub-menu{
background-color:#fff;
  padding:20px;
  margin:10px;
}
.user-info{
  display:flex;
  align-items:center;
}
  </style>
</head>
<body>
  <div class="hero">
    <nav class="bg-dark">
      <i class="mt-2" style="font-size:20px; color:#fff;">PhotoCollection</i>
      <ul class="mt-3">
        <li class="ps-4 "><a href="{{route('photo.index')}}"  class="text-decoration-none" style="color:#fff;">Home</a></li>
        <li class="ps-4 "><a href="{{route('photo.create')}}"  class="text-decoration-none" style="color:#fff;">Create</a></li>
        <li class="ps-4 "><a href="{{route('pf.index')}}"  class="text-decoration-none" style="color:#fff;">Profile</a></li>
      </ul>
      <img src="{{asset('img/images.jpg')}}" alt="logo" class="logo"  onclick="toggleMenu()">
      <div class="sub-menu-wrap" id="subMenu">
      <div class="sub-menu">
        <div class="user-info">
 <img src="{{asset('img/images.jpg')}}" alt="pic" class="text-center logo">
 <h3 class="text-center">Helo pic</h3>
</div>
</div>
      </div>
</nav>
</div>
<script>
  let  subMenu = document.getElimentById('subMenu');
  function toggleMenu(){
    subMenu.classlist.toggle("open-menu");
  }
</script>
</body>
</html>