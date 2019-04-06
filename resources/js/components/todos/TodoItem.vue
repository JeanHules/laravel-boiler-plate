<template>
	<div class="d-flex justify-content-between">
		<div>
			<p class="my-0" :class="[ task.completed ? 'line-through' : '']">{{ task.title }}</p>
		</div>
		<div class="d-flex">
			<a @click.prevent="$emit('toggleStatus', task)" href="" class="mr-3 text-dark">
				<i v-if="task.completed" class="fas fa-check-square"></i>
				<i v-else class="far fa-square"></i>
			</a>
			<a @click.prevent="$emit('deleteTask', task)" href=""><i class="fas fa-trash"></i></a>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			task: {
				required: true
			}
		}
	}
</script>