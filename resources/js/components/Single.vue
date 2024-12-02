<template>
    <div v-if="card" class="p-4">
      <div class="flex flex-col bg-white shadow-md rounded-lg p-4">
        
        <div class="flex w-full justify-center">
            <a :href="`${card.scryfall_uri}`"><img :src="card.image" :alt="card.name" class="w-full h-auto mt-2 justify-center" /></a>
            <div class="w-1/2 m-auto">
                <h1 class="text-xl font-bold">{{ card.name }}</h1>
                <p class="text-gray-600">CMC: {{ card.cmc }}</p>
                <p class="text-gray-800">Type: {{ card.type }}</p>
                <p class="text-gray-600">Text: {{ card.text }}</p>
                
            </div>
        </div>
        
        
      </div>
    </div>
    <div v-else>
      <p>Loading...</p>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRoute } from 'vue-router';
  
  interface Card {
    id: number;
    name: string;
    image: string;
    type: string;
    text: string;
    cmc: number;
    scryfall_uri: string;
  }
  
  const card = ref<Card | null>(null);
  const route = useRoute();
  
  const fetchCard = async (name: string) => {
    try {
      const response = await axios.get(`/api/cards/show/${name}`);
      card.value = response.data;
    } catch (error) {
      console.error('Error fetching card:', error);
    }
  };
  
  onMounted(() => {
    const name = route.params.name as string;
    fetchCard(name);
  });
  </script>
  
  <style scoped>
  /* Adicione seus estilos aqui */
  </style>