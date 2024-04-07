<template>
    <div class="container">
      <h2>Products</h2>
      <div class="flex place-content-end mb-4">
            <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-md cursor-pointer " >
                <router-link :to="{ name: 'ProductForm' }" class="text-sm font-medium text-white">Create Product</router-link>
            </div>
        </div>
      <table class="table table-striped">
        <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
      <th scope="col">Product Price</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(product,index) in products" :key="product.id">
      <th scope="row">{{ index+1 }}</th>
      <td>{{ product.name }}</td>
      <td>{{ product.price }}</td>
      <td>{{ product.description?.substr(0,25) }}...</td>
      <td>
         <router-link :to="{ name: 'ProductDetail', params: { id: product.id }}"><i class="fa-solid fa-eye"></i></router-link>
         <i class="fa-solid fa-trash mx-2" @click="deleteProduct(product.id)"></i>
         <router-link :to="{ name: 'ProductEdit', params: { id: product.id }}"><i class="fa-regular fa-pen-to-square " ></i></router-link>
        </td>
    </tr></tbody>
</table>
     
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        products: []
      };
    },
    methods:{
      fetchAllProducts(){
        axios.get('/api/products')
        .then(response => {
          this.products = response.data;
        })
        .catch(error => {
          console.error('Error fetching products:', error);
        });
      },
      deleteProduct(id) {
      axios.delete(`/api/products/${id}`)
        .then(response => {
          this.fetchAllProducts();
          console.log('Product deleted successfully:', response.data);
          // Optionally, redirect to product list or display a success message
        })
        .catch(error => {
          console.error('Error deleting product:', error);
        });
    }
    },
    mounted(){
      this.fetchAllProducts();
    }
  }
  </script>
  