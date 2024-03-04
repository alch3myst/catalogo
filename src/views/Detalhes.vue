<script setup lang="ts">
import Carousel from '@/components/Carousel.vue';
import FaqBox from '@/components/FaqBox.vue';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

import { animate, stagger } from 'motion';

// Dados de exemplo, os do site real vem de um banco de dados
let categoria = ref({})
categoria.value = [
	// Brincos
	{
		nome: "Rosa Encantada",
		id: "BRE001",
		preco: "R$ 1,500.00",
		img: "/img/brincos/brinco1.jpg",
		imgs: ["/img/brincos/brinco1.jpg","/img/brincos/brinco2.jpg"],
		categoria: "Brincos"
	},{
		nome: "Estrela Dourada",
		id: "BRE002",
		preco: "R$ 2,320",
		img: "/img/brincos/brinco2.jpg",
		imgs: ["/img/brincos/brinco2.jpg","/img/brincos/brinco1.jpg"],
		categoria: "Brincos"
	},{
		nome: "Lua Crescente",
		id: "BRE003",
		preco: "R$ 1,750",
		img: "/img/brincos/brinco3.jpg",
		imgs: ["/img/brincos/brinco3.jpg","/img/brincos/brinco2.jpg"],
		categoria: "Brincos"
	},{
		nome: "Pérola Delicada",
		id: "BRE004",
		preco: "R$ 750",
		img: "/img/brincos/brinco4.jpg",
		imgs: ["/img/brincos/brinco4.jpg","/img/brincos/brinco2.jpg"],
		categoria: "Brincos"
	},

	// Colares
	{
		nome: "Colar Serenidade",
		id: "CLR001",
		preco: "R$ 1,750",
		img: "/img/colares/colar1.jpg",
		imgs: ["/img/colares/colar1.jpg","/img/colares/colar2.jpg"],
		categoria: "Colares"
	},{
		nome: "Colar Radiante ",
		id: "CLR002",
		preco: "R$ 2,500",
		img: "/img/colares/colar2.jpg",
		imgs: ["/img/colares/colar2.jpg","/img/colares/colar1.jpg"],
		categoria: "Colares"
	},{
		nome: "Colar Celestial",
		id: "CLR003",
		preco: "R$ 2,800",
		img: "/img/colares/colar3.jpg",
		imgs: ["/img/colares/colar3.jpg","/img/colares/colar2.jpg"],
		categoria: "Colares"
	},

	// Relogios
	{
		nome: "Aurora",
		id: "RE001",
		preco: "R$ 2,200",
		img: "/img/relogios/relogio1.jpg",
		imgs: ["/img/relogios/relogio1.jpg","/img/relogios/relogio2.jpg"],
		categoria: "Relogios"
	},{
		nome: "Harmonia Temporal",
		id: "RE002",
		preco: "R$ 2,800",
		img: "/img/relogios/relogio2.jpg",
		imgs: ["/img/relogios/relogio2.jpg","/img/relogios/relogio1.jpg"],
		categoria: "Relogios"
	},

	// Perfume
	{
		nome: "Noturno",
		id: "PRF001",
		preco: "R$ 720",
		img: "/img/perfumes/perfume1.jpg",
		imgs: ["/img/perfumes/perfume1.jpg","/img/perfumes/perfume2.jpg"],
		categoria: "Perfumes"
	},{
		nome: "Essência Floral",
		id: "PRF002",
		preco: "R$ 820",
		img: "/img/perfumes/perfume2.jpg",
		imgs: ["/img/perfumes/perfume2.jpg","/img/perfumes/perfume1.jpg"],
		categoria: "Perfumes"
	},{
		nome: "Serenata",
		id: "PRF002",
		preco: "R$ 720",
		img: "/img/perfumes/perfume3.jpg",
		imgs: ["/img/perfumes/perfume3.jpg","/img/perfumes/perfume2.jpg"],
		categoria: "Perfumes"
	}
]

let selected = ref({})
let route = useRoute()
onMounted(() => {
	categoria.value!.forEach(e => {
		if(e.id == route.params.id) {
			selected.value = e
			return
		}
	});

	animate("section.go-back, section.prod-pics, section.prod-data", 
		{
			opacity: [0, 1]
		},
		{
			duration: 1,
			delay: stagger(.1)
		}
	)
})
</script>

<template>
	<div style="margin-top: 90px;"></div>

	<section class="go-back">
		<RouterLink :to="`/Categoria/${selected.categoria}`">{{ selected.categoria }}</RouterLink>
	</section>
	<div class="main">

		<section class="prod-pics">
			<!-- <img :src="selected.img" alt=""> -->
			<Carousel :imagens="selected.imgs" />
		</section>

		<section class="prod-data">
			<div class="data" style="margin-top: 0;">
				<h1 class="prod-data-nome">{{ selected.nome }}</h1>
				<p class="prod-data-preco">{{ selected.preco }}</p>
				<button>Agendar Visita</button>
				
				<p>Uma nova dimensão da elegância, onde cada criação é uma experiência que transcende o comum, elevando o significado do luxo e da beleza.</p>
			</div>

			<div class="data">
				<FaqBox 
				titulo="Materiais Utilizados nas Joias"
				conteudo="Utilizamos apenas materiais de alta qualidade, como ouro 18k, platina e diamantes certificados, garantindo a excelência e a durabilidade de nossas peças."
				/>

				<FaqBox 
				titulo="Garantia para as Peças"
				conteudo="Oferecemos garantia para todas as nossas joias, cobrindo defeitos de fabricação por um período determinado. Consulte nossos termos de garantia para mais detalhes."
				/>

				<FaqBox 
				titulo="Cuidados com as Joias"
				conteudo="Para manter a beleza de suas joias, recomendamos limpeza regular com produtos suaves, armazenamento em locais apropriados e evitar contato com substâncias corrosivas. Saiba mais em nossa seção de cuidados com as joias."
				/>
			</div>
		</section>
	</div>
</template>

<style lang="scss" scoped>
section.go-back {
	font-size: 1.1rem;
	margin: 0 10vw;
}

div.main {
	margin: 10px 10vw;
	display: grid;
	grid-template-columns: 1.8fr 1fr;
	column-gap: 15px;
}
section.prod-pics {
	width: 100%;
	height: 70vh;
	position: sticky;
	top: 88px;
	& img {
		width: 100%;
		object-fit: cover;
	}
}

section.prod-data {
	& .data {
		background-color: #fff;
		padding: 15px;
		margin-top: 15px;
	}
}

section.prod-data {
	& .prod-data-preco {
		font-size: 1.5rem;
	}
	& button {
		width: 100%;
		border: none;
		padding: 15px;
		margin: 20px 0;
		background-color: #E8FAB9;
		font-size: 1.1rem;
		font-weight: bold;
		cursor: pointer;
	}
}

@media screen and (max-width: 950px) {
	div.main {
		grid-template-columns: 1fr;
	}

	section.prod-pics {
		position: relative;
		top: auto;
	}

	section.prod-data {
		margin-top: 15px;
		& .data {
			height: auto;
		}
	}

	section.prod-pics {
		width: 100%;
		height: 50vh;
	}
}
</style>