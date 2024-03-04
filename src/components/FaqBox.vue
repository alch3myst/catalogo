<script lang="ts" setup>
import { ref } from 'vue';


let isOpen = ref(false)
let props = defineProps({
	titulo: {
		type: String,
		required: true
	},
	conteudo: {
		type: String,
		required: true
	}
})
				
function toggleDropdown() {
	isOpen.value = !isOpen.value;
}
</script>

<template>
	<div class="faq-dropdown">
		<h3 class="faq-title" @click="toggleDropdown">
			{{ titulo }}
		</h3>
		<div :class="{'isOpen': isOpen}" class="faq-content">
			{{ conteudo }}
		</div>
	</div>
</template>
  
<style>
	.faq-dropdown {
		margin-bottom: 10px;
	}

	.faq-title {
		cursor: pointer;
		font-weight: bold;
		border-bottom: 1px solid #59447a79;
		padding: 10px;
	}

	.faq-content {
		padding: 10px 10px 0 10px;
		height: 1px;
		overflow: hidden;
	}

	.isOpen {
		height: auto;
	}
</style>
  