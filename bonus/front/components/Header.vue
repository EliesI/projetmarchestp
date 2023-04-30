<template>
  <div class="aaa">
<header class="bg-darker pl-1">
  <nav>
    <ul class="flex items-center">
      <li>
        <nuxt-link to="/">
          <img src="/uploads/visuals/logo-removebg.png" alt="Logo" class="w-20">
        </nuxt-link>
      </li>
      <li class="ml-4"><nuxt-link to="/Shop">Shop</nuxt-link></li>
      <li class="ml-4">
        <nuxt-link to="/Categories">Categories</nuxt-link>
        <ul class="bg-darker">
          <li><nuxt-link to="/Category/sensory">Sensory</nuxt-link></li>
          <li><nuxt-link to="/Category/physical">Physical</nuxt-link></li>
          <li><nuxt-link to="/Category/health">Health</nuxt-link></li>
          <li><nuxt-link to="/Category/mental">Mental</nuxt-link></li>
          <li><nuxt-link to="/Category/implant accessory">Implant accessory</nuxt-link></li>
        </ul>
      </li>
      <li class="ml-4">
        <nuxt-link to="/Collections">Collections</nuxt-link>
        <ul class="bg-darker">
          <li><nuxt-link to="/Collection/military">Military</nuxt-link></li>
          <li><nuxt-link to="/Collection/scientist">Scientist</nuxt-link></li>
          <li><nuxt-link to="/Collection/powerfull">Powerfull</nuxt-link></li>
          <li><nuxt-link to="/Collection/espionage">Espionage</nuxt-link></li>
          <li><nuxt-link to="/Collection/premium pack">Premium Pack</nuxt-link></li>
        </ul>
      </li>
      <li class="ml-4"><nuxt-link to="/About">About</nuxt-link></li>
      <li class="ml-4"><nuxt-link to="/login">Login</nuxt-link></li>
    </ul>
  </nav>
</header>
</div>
</template>

  <style>
  header {
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 0;
  }

  nav ul {
    list-style: none;
    display: flex;
  }
  
  nav li {
    margin-right: 1rem;
    position: relative; 
  }
  
  nav a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.2rem;
    display: block; 
    padding: 0.5rem; 
  }
  
  nav ul ul {
    position: absolute;
    top: 100%; 
    left: 0;
    visibility: hidden;
    opacity: 0;
    z-index: 20;
    transition: visibility 0s, opacity 0.5s ease;
  }
  
  nav ul li:hover > ul {
    visibility: visible;
    opacity: 1;
    transition: visibility 0s, opacity 0.5s ease;
  }
  
  nav ul ul li {
    margin-top: 0.5rem;
  }
  
  nav ul ul a {
    font-size: 1rem;
  }
  </style>
  