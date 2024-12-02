<template>
    <div class="p-4">
      <div v-if="commanders && commanders.data" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <div v-for="commander in commanders.data" :key="commander.id" class="bg-gray-50 shadow-md rounded-lg p-4">
          <RouterLink :to="`/cards/${commander.name}`">
            <img :src="commander.image" :alt="commander.name" class="w-full h-auto mt-2" />
            <h1 class="text-xl font-bold">{{ commander.name }}</h1>
          </RouterLink>
        </div>
      </div>
      <div v-else>
        <p>No commanders found.</p>
      </div>
      <div v-if="commanders" class="flex justify-center mt-4">
        <button @click="fetchCommander(commanders.prev_page_url ?? undefined)" :disabled="!commanders.prev_page_url" class="btn btn-primary font-bold m-2 shadow-md px-5 py-2 bg-gray-50 rounded-md">Previous</button>
        <button @click="fetchCommander(commanders.next_page_url ?? undefined)" :disabled="!commanders.next_page_url" class="btn btn-primary font-bold m-2 shadow-md px-5 py-2 bg-gray-50 rounded-md">Next</button>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  interface Commander {
    id: number;
    name: string;
    image: string;
  }
  
  interface PaginatedCommanders {
    data: Commander[];
    prev_page_url: string | null;
    next_page_url: string | null;
  }
  
  const commanders = ref<PaginatedCommanders | null>(null);
  
  const fetchCommander = async (url = '/api/commander/12') => {
    try {
      const response = await axios.get(url);
      commanders.value = response.data;
    } catch (error) {
      console.error('Error fetching commanders:', error);
    }
  };
  
  onMounted(() => {
    fetchCommander();
  });
  </script>
  
  <style scoped>
  /* Adicione seus estilos aqui */
  </style>