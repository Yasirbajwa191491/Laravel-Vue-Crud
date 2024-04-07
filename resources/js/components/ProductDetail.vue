<template>
    <div class="container">
      <h2>Product Detail</h2>
      <div v-if="product" class="card">
        <div class="card-body">
          <p class="card-text"><strong>Name:</strong> {{ product.name }}</p>
          <p class="card-text"><strong>Description:</strong> {{ product.description }}</p>
          <p class="card-text"><strong>Price:</strong> {{ product.price }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        product: null
      };
    },
    created() {
      this.fetchProduct();
    },
    methods: {
      fetchProduct() {
        axios.get(`/api/products/${this.$route.params.id}`)
          .then(response => {
            this.product = response.data;
          })
          .catch(error => {
            console.error('Error fetching product:', error);
          });
      }
    }
  }
  </script>
  