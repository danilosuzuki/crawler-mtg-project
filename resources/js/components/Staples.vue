<template>
  <div class="p-4">
    <div v-if="staples && staples.data" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
      <div v-for="staple in staples.data" :key="staple.id" class="bg-gray-50 shadow-md rounded-lg p-4">
        <RouterLink :to="`/cards/${staple.name}`">
          <img :src="staple.image" :alt="staple.name" class="w-full h-auto mt-2" />
          <p class="text-gray-600">Appearances: {{ staple.appearences }}</p>
          <h1 class="text-xl font-bold">{{ staple.name }}</h1>
        </RouterLink>
      </div>
    </div>
    <div v-else>
      <p>No staples found.</p>
    </div>
    <div v-if="staples" class="flex justify-center mt-4">
      <button @click="fetchStaples(staples.prev_page_url ?? undefined)" :disabled="!staples.prev_page_url" class="btn btn-primary font-bold m-2 shadow-md px-5 py-2 bg-gray-50 rounded-md">Previous</button>
      <button @click="fetchStaples(staples.next_page_url ?? undefined)" :disabled="!staples.next_page_url" class="btn btn-primary font-bold m-2 shadow-md px-5 py-2 bg-gray-50 rounded-md">Next</button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';

interface Staple {
  id: number;
  name: string;
  appearences: number;
  image: string;
}

interface PaginatedStaples {
  data: Staple[];
  prev_page_url: string | null;
  next_page_url: string | null;
}

const staples = ref<PaginatedStaples | null>(null);

const fetchStaples = async (url = '/api/staple/12') => {
  try {
    const response = await axios.get(url);
    staples.value = response.data;
  } catch (error) {
    console.error('Error fetching staples:', error);
  }
};

onMounted(() => {
  fetchStaples();
});
</script>

<style scoped>
/* Adicione seus estilos aqui */
</style>