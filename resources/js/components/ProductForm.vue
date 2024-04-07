<template>
    <div class="container">
      <h2>Add Product</h2>
      <form @submit.prevent="saveProduct" class="mb-4">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea id="description" v-model="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="price">Price:</label>
          <input type="number" id="price" v-model.number="price" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
        description: '',
        price: ''
      };
    },
    methods: {
      saveProduct() {
        axios.post('/api/products', {
          name: this.name,
          description: this.description,
          price: this.price
        })
        .then(response => {
          this.$router.push('/products');
        })
        .catch(error => {
          console.error('Error creating product:', error);
        });
      }
    }
  }
  </script>
  