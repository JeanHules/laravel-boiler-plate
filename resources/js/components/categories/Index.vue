<template>
	<div>
		<ul class="list-group position-relative -mt-5 shadow-sm">
			<li @click.prevent="selectCategory(category)" v-for="category in categories" :key="category.id" class="list-group-item"><a href="">{{ category.title }}</a></li>
			<li @click.prevent="$emit('hideCategories')" class="list-group-item list-group-item-danger font-weight-bold" style="cursor: pointer">Close</li>
		</ul>
	</div>
</template>

<script>
	export default {
		data: () => ({
			categories: [],
			selectedCategory: ''
		}),
		methods: {
			getCategories() {
				axios.get(`/api/categories`)
					.then(response => {
						this.categories = response.data;
					});
			},
			selectCategory(category) {
				this.selectedCategory = category;
				this.$emit('hideCategories');
				this.$emit('selectedCategory',category);
			}
		},
		created() {
			this.getCategories();
		}
	}
</script>