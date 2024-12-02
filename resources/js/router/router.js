import { createRouter, createWebHistory } from 'vue-router';
import Single from '../components/Single.vue';
import Staples from '../components/Staples.vue';
import Commanders from '../components/Commanders.vue';

const routes = [
  { path: '/', component: Staples },
  { path: '/cards/:name', component: Single, props: true },
  { path: '/commanders', component: Commanders},
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;