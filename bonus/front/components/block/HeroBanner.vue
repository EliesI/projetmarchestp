<template>
    <div class="banner w-full z-20 bg-darker">
      <h1>{{ title }}</h1>
      <p>{{ description }}</p>
      <a :href="buttonLink" class="button bg-gradient-to-b from-yellow">{{ buttonText }}</a>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      title: {
        type: String,
        required: true,
      },
      description: {
        type: String,
        required: true,
      },
      buttonLink: {
        type: String,
        required: true,
      },
      buttonText: {
        type: String,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  .banner {
    /* background-image: url('/uploads/visuals/banner.png'); */
    background-size: cover;
    background-position: center;
    height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
  }
  
  .banner h1 {
    font-size: 4rem;
    margin-bottom: 1rem;
    text-align: center;
  }
  
  .banner p {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    text-align: center;
  }
  
  .button {
    color: white;
    padding: 1rem 2rem;
    border-radius: 0.25rem;
    font-size: 1.25rem;
    text-decoration: none;
  }
  </style>
  