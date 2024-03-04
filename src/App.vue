<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import { animate, stagger } from 'motion';
import { Transition, onMounted } from "vue";

let menuStatus = false;
function toggleCategory() {
	console.log("div.menu-categorias");
	if (!menuStatus) {
		animate("div.menu-categorias", {
			opacity: [0,1],
			pointerEvents: ["none", "all"]
		})
		
		menuStatus = true
		return
	}
	
	animate("div.menu-categorias", {
		opacity: [1,0],
		pointerEvents: ["all", "none"]
	})
	menuStatus = false
}

onMounted(() => {
	document.querySelectorAll("div.menu-categorias a").forEach(e => {
		e.addEventListener("click", function () {
			animate("div.menu-categorias", {
				opacity: [1,0],
				pointerEvents: ["all", "none"]
			})
			menuStatus = false
		})
	})

	// Animations
	animate(document.querySelectorAll(".nav-animate")!, {
		opacity: [0, 1]
	},
	{
		duration: .9,
		delay: stagger(.3)
	});
})

</script>

<template>
	<header>
		<nav class="nav-menu">
			<div class="nav-animate">
				<RouterLink to="/" style="display: flex;">
					<img src="/img/diamond.svg" alt="logo" width="25">
					<b>Luminara</b>
				</RouterLink>
				<p class="menu-category-btn" @click="toggleCategory">Cagatórias</p>
			</div>
			
			<div class="nav-animate">
				<RouterLink to="/Contato">Contato</RouterLink>
			</div>

			<div class="menu-categorias">
				<RouterLink to="/Categoria/Brincos">Brincos</RouterLink>
				<RouterLink to="/Categoria/Relogios">Relógios</RouterLink>
				<RouterLink to="/Categoria/Perfumes">Perfumes</RouterLink>
				<RouterLink to="/Categoria/Colares">Colares</RouterLink>
			</div>
		</nav>
	</header>

	<main>
		<RouterView />
	</main>

  <footer>
	<ul>
		<li>Insta</li>
		<li>Youtube</li>
		<li>Facebook</li>
	</ul>
	<small>Luminara 2023</small>
  </footer>
</template>

<style scoped lang="scss">
$mainColor: #2c1c45;
.nav-menu {
	display: flex;
	padding: 15px 10vw;
	box-shadow: 2px 0 15px rgba(65, 17, 102, 0.081);
	flex-direction: row;
	justify-content: space-between;
	height: 55px;
	z-index: 90;
	background: hsl(260, 11%, 95%);
	position: fixed;
	width: 100vw;
	top: 0;

	& div {
		align-items: center;
		display: flex;
	}

	& img {
		top: 1px;
		margin-right: 5px;
	}

	& {
		b {
			font-size: 1.2rem;
			margin-right: 20px;
		}
	}
}

.menu-categorias {
	position: absolute;
	top: 55px;
	left: 0;
	background: #f1f0f3;
	width: 100vw;
	padding: 15px 10vw;

	pointer-events: none;
	opacity: 0;

	& a {
		margin-right: 15px;
	}
}

.menu-category-btn {
	cursor: pointer;
}

footer {
	border-top: 1px solid #59447a2c;
	text-align: center;
	
	& ul {
		padding: 15px;
		display: flex;
		grid-template-columns: repeat(3, 1fr);
		justify-content: center;
		& li {
			margin-right: 10px;
		}
	}
	& small {
		padding: 10px;
	}
}

@media screen and (max-width: 650px) {
	.menu-categorias {
		justify-content: center;
	}
}
</style>
