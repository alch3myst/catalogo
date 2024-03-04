import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CategoriaView from '../views/Categoria.vue'
import DetalhesView from '../views/Detalhes.vue'
import ContatoView from '../views/Contato.vue'

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			path: '/',
			name: 'home',
			component: HomeView
		},{
			path: '/Categoria/:categoria',
			name: 'categoria',
			component: CategoriaView
		},{
			path: '/Detalhe/:id',
			name: 'detalhe',
			component: DetalhesView
		},{
			path: '/Contato',
			name: 'contato',
			component: ContatoView
		}
	]
})

export default router
