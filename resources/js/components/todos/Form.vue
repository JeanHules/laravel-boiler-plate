<template>
	<div>
		<div class="form-group">
			<input v-model="inputData.title" @keyup.enter="submit" type="text" class="form-control">
		</div>
		<div class="d-flex justify-content-between">
			<div>
				<a @click.prevent="submit" href="" class="btn btn-primary font-weight-bold mr-2">{{ buttonText }}</a>
				<a @click.prevent="$emit('hide')" href="" class="text-dark">Cancel</a>
			</div>
			<div>
				<a href="" class="text-dark"><i class="fas fa-layer-group"></i> Tags</a>
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
			},
			buttonText() {
				return this.task ? 'Save' : 'Add Task';
			}
		},
		methods: {
			submit() {
				if (this.inputData.title.length > 0) {
					if (this.task) {
						axios.put(`/api/tasks/${this.task.id}`, this.postData)
							.then(response => {
								this.$emit('hide');
								this.$emit('updated');
							})
					} else {
						axios.post(`/api/tasks`, this.postData)
							.then(response => {
								this.$emit('hide');
								this.$emit('updated');
							})
					}

				}

			}
		},
		created() {
			if (this.task) {
				this.inputData = this.task;
			}
		}
	}
</script>