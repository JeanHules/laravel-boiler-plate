<template>
	<div>
		<ul class="list-group position-relative -mt-5">
			<li class="list-group-item">Test</li>
			<li class="list-group-item">Test 2</li>
		</ul>
	</div>
</template>

<script>
	import CategoryForm from './Form'
	export default {
		components: {
			CategoryForm
		},
		data: () => ({

		}),
		methods: {
			getCategory() {
				axios.get(`/api/categories`)
					.then(response => {
						
					})
			}
		}
	}
</script>