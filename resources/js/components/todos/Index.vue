<template>
	<div class="row d-flex justify-content-center">
		<div class="col-sm-8">
			<div class="card card-body shadow-sm border-0" style="height:100vh">
				<template>
					<ul class="list-unstyled">
						<li>
							<h4>Today, <span class="welcome-date">{{ today | niceDate }}</span></h4>
						</li>
						<li v-if="tasks.length == 0 && !firstTime">
							<a @click.prevent="firstTime = true" href=""><i class="fas fa-plus mr-2"></i>Add task</a>
						</li>
						<li v-if="firstTime && tasks.length == 0" class="mt-3">
							<task-form @hide="firstTime = false" @updated="getTasks"></task-form>
						</li>
					</ul>
				</template>
				<template v-if="!tasks.length && !firstTime">
					<div class="text-center">
						<img class="center-block pt-4" src="/img/empty_state.svg" alt="" height="150px">
						<h5 class="mt-3">It's always great to stay organized.</h5>
						<p class="text-muted">All your scheduled tasks will show up here.</p>
						<a @click.prevent="firstTime = true" class="btn btn-primary" href=""><i class="fas fa-plus mr-2"></i>Add a task</a>
					</div>
				</template>
				<template v-if="tasks.length">
					<div class="row">
						<div class="form-group col-sm-8">
							<input v-model="searchText" type="text" class="form-control" placeholder="Search your task">
						</div>
						<div class="col-sm-4">
							<div class="btn-group d-flex" role="group" aria-label="Basic example">
								<a href="" @click.prevent="tab = -1" class="btn w-100" 
									:class="[tab == -1 ? 'btn-primary' : 'btn-outline-primary']">All</a>
								<a href="" @click.prevent="tab = 1" class="btn w-100"
									:class="[tab == 1 ? 'btn-primary' : 'btn-outline-primary']">Completed</a>
								<a href="" @click.prevent="tab = 0" class="btn w-100"
									:class="[tab == 0 ? 'btn-primary' : 'btn-outline-primary']">Pending</a>
							</div>
						</div>
					</div>
					<ul class="list-group list-group-flush mb-2">
						<li class="list-group-item pl-0 d-flex justify-content-between" 
							v-for="(task,index) in filterdTasks" 
							:key="index">
							<div>
								<p class="my-0 align-items-top">{{ task.title }}</p>
							</div>
							<div class="d-flex">
								<a @click.prevent="toggleStatus(task)" href="" class="mr-3 text-dark">
									<i v-if="task.completed" class="fas fa-check-square"></i>
									<i v-else class="far fa-square"></i>
								</a>
								<a @click.prevent="confirmDelete(task)" href=""><i class="fas fa-trash"></i></a>
							</div>
						</li>
						<li class="list-group-item px-0">
							<a v-if="!showCreate" @click.prevent="showCreate =! showCreate" href=""><i class="fas fa-plus mr-2"></i>Add task</a>
							<task-form v-if="showCreate" @hide="showCreate = false" @updated="getTasks"></task-form>
						</li>
					</ul>
				</template>
			</div>
		</div>
	</div>

</template>

<script>
	import NiceDate from '../../mixins/NiceDate';
	import TaskForm from './Form';
	export default {
		mixins: [NiceDate],
		components: {
			TaskForm
		},
		data: () => ({
			searchText: '',
			tab: -1,
			tasks: [],
			today: new Date(),
			firstTime: false,
			showCreate: false
		}),
		computed: {
			filterdTasks() {
				return this.tasks.filter(task => {
					if (
						(this.tab == 0 && task.completed == 0) ||
						(this.tab == 1 && task.completed  == 1) ||
						this.tab == -1 
						) {
						let searchtitle = `${task.title.toLowerCase()} ${task.title.toLowerCase()}`;
						return searchtitle.indexOf(this.searchText.toLowerCase()) > -1;
					}
				});
			}
		},
		methods: {
			getTasks() {
				axios.get(`/api/tasks`)
					.then(response => {
						this.tasks = response.data;
					});
			},
			toggleStatus(task) {
				axios.put(`/api/tasks/${task.id}`,{
					completed: !task.completed
				}).then(response => {
					this.getTasks();
				});
			},
			updateStatus(task) {
				axios.put(`/api/tasks/${task.id}`, task)
					.then(response => {
						console.log(response.data);
					});
			},
			deleteTask(selectedTask) {
				axios.delete(`/api/tasks/${selectedTask.id}`)
					.then(response => {
						this.tasks = this.tasks.filter(task => {
							return task.id != selectedTask.id;
						});
					});
			},
			confirmDelete(task) {
				swal({
					title: 'Are you sure?',
					text: 'You wont be able to retrieve this record.',
					icon: 'warning',
					buttons: true,
					buttons: ['Cancel', 'Yes, delete!'],
					dangerMode: true,
				})
				.then((willDelete) => {
				  this.deleteTask(task);
				});
			}
		},
		created() {
			this.getTasks();
		}
	}
</script>