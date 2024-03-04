<script setup lang="ts">
import { animate, stagger } from 'motion';
import { onMounted } from 'vue';

import FaqBox from '@/components/FaqBox.vue';
onMounted(() => {
	animate("section.enderecos, section.faq", 
		{
			opacity: [0, 1]
		},
		{
			duration: 1,
			delay: stagger(.2)
		}
	)
})
</script>

<template>
	<div style="margin-top: 55px; height: 1px;"></div>
	<section class="enderecos">
		<h2>Nossas Lojas</h2>
		<div>
			<h3>Loja 1</h3>
			<p>Endereço</p>
			<p>(99) 99999-9999</p>
		</div>

		<br>

		<div>
			<h3>Loja 2</h3>
			<p>Endereço</p>
			<p>(99) 99999-9999</p>
		</div>
	</section>

	<section class="faq">
		<h2>Perguntas Frequentes</h2>
		<p>Caso tenha alguma duvida não respondida aqui, ou queira entrar em contato diretamente</p>
		<p>nos mande uma mensagem ou ligue no numero</p>
		<p>(99) 99999-9999</p>

		<br>

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
	</section>
</template>

<style lang="scss" scoped>
section.enderecos, section.faq {
	margin: 30px 10vw;
	background-color: #fff;
	padding: 15px;
}
</style>