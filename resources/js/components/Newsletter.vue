<template>
    <form @submit.prevent="subscribe">
        <div class="grid grid-cols-1 gap-4 bg-white shadow-md rounded-lg p-4 md:grid-cols-3">
            <div class="flex flex-col w-full text-center md:text-left">
                <p class="text-xl font-bold">Newsletter</p>
                <p class="text-md">Subscribe to receive TRF-1 ranking updates</p>
            </div>
            <div class="flex flex-col md:flex-row w-full justify-center md:justify-start">
                <input type="email" v-model="email" name="email" id="email" placeholder="Email"
                    class="w-full p-2 m-2 border border-gray-300 rounded-lg" />
                <input type="text" v-model="name" name="name" id="name" placeholder="Name"
                    class="w-full p-2 m-2 border border-gray-300 rounded-lg" />
            </div>
            <div class="flex w-full justify-center md:justify-start">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full md:w-auto">Subscribe</button>
            </div>
        </div>
    </form>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification';

const email = ref('');
const name = ref('');
const toast = useToast();

const subscribe = async () => {
    try {
        const response = await axios.post('/api/subscribe', {
            email: email.value,
            name: name.value,
        });
        toast.success('Subscribed successfully!');
        email.value = '';
        name.value = '';
    } catch (error) {
        console.error('Error subscribing:', error);
        toast.error('Failed to subscribe.');
    }
};
</script>

<style scoped>
/* Adicione seus estilos aqui, se necessário */
</style>