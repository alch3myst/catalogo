<script lang="ts" setup>
import { ref } from 'vue';


let props = defineProps({
	imagens: Array<String>
})

let currentIndex = ref(0)

  
function nextSlide() {
	currentIndex.value = (currentIndex.value + 1) % props.imagens.length;
}

function prevSlide() {
	currentIndex.value = (currentIndex.value - 1 + props.imagens.length) % props.imagens.length;
}
</script>

<template>
	<div class="carousel">
		<template v-for="(image, index) in props.imagens">
			<div class="slide" v-if="index === currentIndex">
				<img :src="image">
			</div>
		</template>
		<div class="controls">
			<button @click="prevSlide">
				<img src="/img/arrow.svg" alt="Anterior" style="width: 25px; rotate: 180deg;"/>
			</button>
			<button @click="nextSlide">
				<img src="/img/arrow.svg" alt="Proximo" style="width: 25px;"/>
			</button>
		</div>
	</div>
</template>
  
<style scoped lang="scss">
	.carousel {
		position: relative;
		overflow: hidden;
		width: 100%;
		height: 100%;

		& img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
	}

	
	.slide {
		height: 100%;
	}
	
	.controls {
		position: absolute;
		bottom: 10px;
		left: 50%;
		transform: translateX(-50%);
		display: grid;
		grid-template-columns: 1fr 1fr;
		grid-gap: 10px;

		& button {
			border: none;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 5px;
			background: #faf7fc07;
			backdrop-filter: blur(2px);

			cursor: pointer;
		}
		& button:nth-child(1) img {
			left: -1px;
		}
		& button:nth-child(2) img {
			left: 1px;
		}
	}
</style>
  