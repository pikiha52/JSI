import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue';
import BookView from '../views/BookView.vue';
import UsersView from '../views/UsersView.vue';
import BorrowView from '../views/BorrowView.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/books',
    name: 'books',
    component: BookView
  },
  {
    path: '/users',
    name: 'users',
    component: UsersView
  },
  {
    path: '/borrow',
    name: 'borrow',
    component: BorrowView
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
