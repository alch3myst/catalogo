<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { animate, inView } from 'motion';

// Dados de exemplo, os do site real vem de um banco de dados
let categoriesData = ref([{}])
categoriesData.value = [
	{
		"category": "Brincos",
		"img": "/img/Brincos.jpg"
	},{
		"category": "Colares",
		"img": "/img/Colares.jpg"
	},{
		"category": "Perfumes",
		"img": "/img/Perfumes.jpg"
	},{
		"category": "Relogios",
		"img": "/img/Relogios.jpg"
	}
]

let maisVendidos = ref([{}])
maisVendidos.value = [
	{
		nome: "Rosa Encantada",
		id: "BRE001",
		preco: "R$ 1,500.00",
		img: "/img/brincos/brinco1.jpg",
		categoria: "Brincos"
	},{
		nome: "Colar Serenidade",
		id: "CLR001",
		preco: "R$ 1,750",
		img: "/img/colares/colar1.jpg",
		categoria: "Colares"
	},{
		nome: "Aurora",
		id: "RE001",
		preco: "R$ 2,200",
		img: "/img/relogios/relogio1.jpg",
		categoria: "Relogios"
	},{
		nome: "Noturno",
		id: "PRF001",
		preco: "R$ 720",
		img: "/img/perfumes/perfume1.jpg",
		categoria: "Perfumes"
	}
]


onMounted(() => {
	inView("div.hero-text, section.latest, section.mais-vendidos, div.hero-bg", (info) => {
  		animate(info.target, 
			{
				opacity: [0, 1],
			},
			{
				offset: [0.2, 1],
				duration: .8
			}
		)
	})

	inView("section.categorias, #animate-h1", (info) => {
  		animate(info.target, 
			{
				opacity: [0, 1],
			},
			{
				offset: [0.3, 1],
				duration: 1
			}
		)
	})
})
</script>

<template>
	<section style="margin-top: 55px;">
		<div class="hero-bg"></div>

		<div class="hero-text">
			<h2>Arte em cada detalhe</h2>
			<p>Onde cada peça conta uma história de elegância atemporal, refletindo a beleza única de quem as usa</p>
		</div>
	</section>


	<h1 id="animate-h1">Explore Luminara</h1>
	<section class="categorias">
		<div v-for="c in categoriesData">
			<RouterLink :to="`/Categoria/${c.category}`">
				<img :src="c.img" :alt="c.category">
				<p>{{c.category}}</p>
			</RouterLink>
		</div>
	</section>

	<section class="latest">
		<h2>Experiencia</h2>

		<p>Uma nova dimensão da elegância, onde cada criação é uma experiência que transcende o comum, elevando o significado do luxo e da beleza.</p>

		<video controls muted autoplay loop>
			<source src="/video/nova_experiencia.mp4">
		</video>
	</section>
	
	<section class="mais-vendidos">
		<div v-for="mv in maisVendidos">
			<RouterLink :to="`/Detalhe/${mv.id}`">
				<img :src="mv.img" :alt="mv.nome">
				<p>{{mv.nome}}</p>
				<small>{{mv.preco}}</small>
			</RouterLink>
		</div>
	</section>

</template>

<style scoped lang="scss">
	div.hero-bg {
		background-image: url("/img/hero_bg.jpg");
		height: 90vh;
		width: 100vw;
		background-position: center;
		background-size: cover;
		opacity: 0;
	}

	div.hero-text {
		text-align: center;
		padding: 120px 15vw;
		opacity: 0;

		& p {
			margin-top: 1rem;
			font-size: 1.1rem;
		}
	}

	h1 {
		text-align: center;
	}

	#animate-h1 {
		opacity: 0;
	}
	section.categorias, section.mais-vendidos {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		column-gap: 1rem;
		row-gap: 1rem;
		opacity: 0;

		margin: 80px 10vw;

		& img {
			width: 100%;
			object-fit: cover;
		}

		& p {
			font-size: 1.2rem;
			margin-top: 5px;
		}
	}

	section.mais-vendidos {
		text-align: left;
		margin: 80px 10vw;
		opacity: 0;

		& p {
			font-size: 1.1rem;
		}
	}

	section.latest {
		margin: 80px 10vw;
		text-align: center;
		opacity: 0;

		& p {
			margin: 20px;
		}

		& video {
			width: 100%;
			object-fit: cover;
			height: 50vh;
			min-height: 420px;
		}
	}

	@media screen and (max-width: 950px) {
		section.categorias, section.mais-vendidos {
			grid-template-columns: repeat(3, 1fr);
		}
	}

	@media screen and (max-width: 650px) {
		section.categorias, section.mais-vendidos {
			grid-template-columns: repeat(2, 1fr);
		}
	}
</style>
