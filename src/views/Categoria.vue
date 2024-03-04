<script setup lang="ts">
import { ref, onMounted, onUpdated } from 'vue';
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
		categoria: "Brincos"
	},{
		nome: "Estrela Dourada",
		id: "BRE002",
		preco: "R$ 2,320",
		img: "/img/brincos/brinco2.jpg",
		categoria: "Brincos"
	},{
		nome: "Lua Crescente",
		id: "BRE003",
		preco: "R$ 1,750",
		img: "/img/brincos/brinco3.jpg",
		categoria: "Brincos"
	},{
		nome: "Pérola Delicada",
		id: "BRE004",
		preco: "R$ 750",
		img: "/img/brincos/brinco4.jpg",
		categoria: "Brincos"
	},

	// Colares
	{
		nome: "Colar Serenidade",
		id: "CLR001",
		preco: "R$ 1,750",
		img: "/img/colares/colar1.jpg",
		categoria: "Colares"
	},{
		nome: "Colar Radiante ",
		id: "CLR002",
		preco: "R$ 2,500",
		img: "/img/colares/colar2.jpg",
		categoria: "Colares"
	},{
		nome: "Colar Celestial",
		id: "CLR003",
		preco: "R$ 2,800",
		img: "/img/colares/colar3.jpg",
		categoria: "Colares"
	},

	// Relogios
	{
		nome: "Aurora",
		id: "RE001",
		preco: "R$ 2,200",
		img: "/img/relogios/relogio1.jpg",
		categoria: "Relogios"
	},{
		nome: "Harmonia Temporal",
		id: "RE002",
		preco: "R$ 2,800",
		img: "/img/relogios/relogio2.jpg",
		categoria: "Relogios"
	},

	// Perfume
	{
		nome: "Noturno",
		id: "PRF001",
		preco: "R$ 720",
		img: "/img/perfumes/perfume1.jpg",
		categoria: "Perfumes"
	},{
		nome: "Essência Floral",
		id: "PRF002",
		preco: "R$ 820",
		img: "/img/perfumes/perfume2.jpg",
		categoria: "Perfumes"
	},{
		nome: "Serenata",
		id: "PRF002",
		preco: "R$ 720",
		img: "/img/perfumes/perfume3.jpg",
		categoria: "Perfumes"
	}
]

function animateProducts() {

	animate("div.product-item", 
		{
			opacity: [0, 1],
		},
		{
			duration: 1,
			delay: stagger(.1)
		}
	)

}

onMounted(() => {
	animate(document.querySelectorAll("section.menu-categorias a, #canimate-h2"), 
		{
			opacity: [0, 1],
			y: [10, 0]
		},
		{
			duration: .5,
			delay: stagger(.1),
			easing: 'ease-out'
		}
	)
	animateProducts()
})

onUpdated(() => {
	animateProducts()
})

</script>

<template>
	<h2 id="canimate-h2" style="margin: 90px 10vw 0 10vw;">{{ $route.params.categoria }}</h2>
	
	<section class="menu-categorias">
		<RouterLink to="/Categoria/Brincos">Brincos</RouterLink>
		<RouterLink to="/Categoria/Relogios">Relógios</RouterLink>
		<RouterLink to="/Categoria/Perfumes">Perfumes</RouterLink>
		<RouterLink to="/Categoria/Colares">Colares</RouterLink>
	</section>
	
	<section class="mais-vendidos">
		<template v-for="ct in categoria">
			<div class="product-item" v-if="ct.categoria == $route.params.categoria">
				<RouterLink :to="`/Detalhe/${ct.id}`">
					<img :src="ct.img" :alt="ct.nome">
					<p>{{ct.nome}}</p>
					<small>{{ct.preco}}</small>
				</RouterLink>
			</div>
		</template>
	</section>
</template>

<style lang="scss" scoped>
	section.mais-vendidos {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		column-gap: 1rem;
		row-gap: 5rem;

		margin: 50px 10vw;

		& img {
			width: 100%;
			object-fit: cover;
			aspect-ratio: 1/1;
		}

		& p {
			font-size: 1.2rem;
			margin-top: 5px;
		}
	}

	section.mais-vendidos {
		text-align: left;
		margin: 30px 10vw;

		& p {
			font-size: 1.1rem;
		}
	}

	section.menu-categorias {
		width: 100%;
		margin: 20px 10vw;

		& a {
			margin-right: 15px;
		}
	}

	div.product-item {
		opacity: 0;
	}

	@media screen and (max-width: 650px) {
		section.mais-vendidos {
		display: grid;
			grid-template-columns: repeat(2, 1fr);
		}

		section.menu-categorias {
			width: auto;
		}
	}
</style>