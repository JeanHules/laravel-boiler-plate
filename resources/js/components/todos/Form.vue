<template>
	<div>
		<div class="form-group">
			<input v-model="inputData.title" @keyup.enter="submit" type="text" class="form-control">
		</div>
		<div class="d-flex justify-content-between">
			<div>
				<a @click.prevent="submit" href="" class="btn btn-primary font-weight-bold mr-2">Add Task</a>
				<a @click.prevent="$emit('hide')" href="" class="text-dark">Cancel</a>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			task: {
				required: false
			}
		},
		data: () => ({
			inputData: {
				title: '',
				category_id: ''
			}
		}),
		computed: {
			postData() {
				return {
					title: this.inputData.title,
					category_id: this.inputData.category	
				}
			}
		},
		methods: {
			submit() {
				if (this.inputData.title.length > 0) {
					axios.post(`/api/tasks`, this.postData)
						.then(response => {
							this.$emit('hide');
							this.$emit('updated');
						})
				}

			}
		},
		created() {
			if (this.task) {
				this.inputData.task = this.task;
			}
		}
	}
</script>