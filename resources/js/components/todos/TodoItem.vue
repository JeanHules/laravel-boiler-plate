<template>
	<div>
		<div v-if="!showForm" class="d-flex justify-content-between">
			<div @click.prevent="toggleForm" class="w-75">
				<h6 class="my-0" :class="[ task.completed ? 'line-through' : '']">{{ task.title }}</h6>
				<div class="welcome-date d-flex">
					<p class="my-0 text-muted mr-3">{{ task.created_at | niceDate }}</p>
					<div>
						<span>#me </span>
					</div>
				</div>
			</div>
			<div class="d-flex">
				<a @click.prevent="$emit('toggleStatus', task)" href="" class="mr-3 text-dark">
					<i v-if="task.completed" class="fas fa-check-square"></i>
					<i v-else class="far fa-square"></i>
				</a>
				<a @click.prevent="$emit('deleteTask', task)" href=""><i class="fas fa-trash"></i></a>
			</div>
		</div>
		<todo-form v-else :task="task" @hide="toggleForm"></todo-form>
	</div>

</template>

<script>
	import TodoForm from './Form';
	import NiceDate from '../../mixins/NiceDate'
	export default {
		mixins: [NiceDate],
		components: {
			TodoForm
		},
		props: {
			task: {
				required: true
			}
		},
		data: () => ({
			showForm: false
		}),
		methods: {
			toggleForm() {
				return this.showForm =! this.showForm;
			}
		}
	}
</script>