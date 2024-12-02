<template>
    <div class="bg-sky-100 flex flex-col min-h-screen">
        <Header />
        <main class="flex-grow">
            <router-view></router-view>
            <Newsletter />
        </main>
        <Footer />
    </div>
</template>
  
<script setup lang="ts">
    import Header from './components/Header.vue';
    import Footer from './components/Footer.vue';
    import Newsletter from './components/Newsletter.vue';
</script>
  
<style scoped>
  
</style>