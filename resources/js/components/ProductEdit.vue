<template>
    <div class="container">
      <h2>Edit Product</h2>
      <form @submit.prevent="updateProduct" class="mb-4">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="product.name" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea id="description" v-model="product.description" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="price">Price:</label>
          <input type="number" id="price" v-model.number="product.price" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
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
      },
      updateProduct() {
        axios.put(`/api/products/${this.$route.params.id}`, this.product)
          .then(response => {
            console.log('Product updated successfully:', response.data);
            this.$router.push('/products');

          })
          .catch(error => {
            console.error('Error updating product:', error);
          });
      }
    }
  }
  </script>
  