<template>
    <div id="right">
        <div v-show="err.error" id="error" class="alert">{{ err.message }}</div>
        <h1>Development Crm</h1>
        <div class="horizontal">
            <img src="/images/horizontal.png" />
        </div>

        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s
        </p>

        <div class="users-icon"><img src="/images/users.png" /></div>

        <div class="tasks">
            <div class="add-tasks">
                <h2>Today's Task</h2>
                <div class="add-action"><img src="/images/add.png" /></div>
            </div>

            <ul class="tasks-list">
                <li v-for="task in todayTasks" v-bind:key="task.id">
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input
                                    type="checkbox"
                                    name="test"
                                    :checked="task.completed"
                                    @change="updateTodayTask(task.taskId)"
                                />
                                <span></span>
                            </label>

                            <h4>{{ task.title }}</h4>
                        </div>
                        <div class="right">
                            <img src="/images/edit.png" />
                            <img
                                src="/images/del.png"
                                @click="deleteTask(task.taskId)"
                            />

                            <button
                                v-bind:class="{
                                    inprogress: !task.approved,
                                    approved: task.approved,
                                }"
                            >
                                {{ task.approved ? "Approved" : "In progress" }}
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="upcoming">
            <div class="add-tasks">
                <h2>Upcoming</h2>
                <div class="add-action">
                    <img src="/images/add.png" alt="" />
                </div>
            </div>
            <form
                id="upcoming-task-form"
                action=""
                @submit.prevent="addUpcomingTask"
            >
                <input type="text" v-model="newTask" />
            </form>

            <ul class="tasks-list">
                <li v-for="task in upcomingTasks" :key="task.id">
                    <div class="info">
                        <div class="left">
                            <label for="" class="myCheckbox">
                                <input
                                    type="checkbox"
                                    name="test"
                                    id=""
                                    :checked="task.completed"
                                    @change="checkUpcoming(task.taskId)"
                                />
                                <span></span>
                            </label>
                            <h4>{{ task.title }}</h4>
                        </div>
                        <div class="right">
                            <img src="/images/edit.png" alt="" srcset="" />
                            <img
                                src="/images/del.png"
                                alt=""
                                srcset=""
                                @click="delUpcoming(task.taskId)"
                            />
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            todayTasks: [],
            upcomingTasks: [],
            newTask: "",
            err: {
                error: false,
                id: "",
                message: "",
            },
        };
    },
    created() {
        this.fetchTodayTasks();
        this.fetchUpcomingTasks();
    },
    methods: {
        async fetchUpcomingTasks() {
            const res = await fetch("/api/upcoming", {
                accept: "application/json",
            });
            const data = await res.json();
            console.log(data);
            this.upcomingTasks = data;
        },
        async fetchTodayTasks() {
            const res = await fetch("/api/dailytask", {
                accept: "application/json",
            });
            const data = await res.json();
            console.log(data);
            this.todayTasks = data;
        },
        checkUpcoming(id) {
            console.log("d");
            if (this.todayTasks.length > 10) {
                this.err = {
                    error: true,
                    id: "daily-task-length",
                    message: "Complete remainignn daily tasks",
                };
                return;
            }
            return this.addTodayTask(id);
        },
        async delUpcoming(id) {
            const res = await fetch("/api/upcoming/" + id, {
                method: "DELETE",
            });
            const data = await res.json();
            if (data === 0) {
                this.err = {
                    error: true,
                    id: "task-not-deleted",
                    message: "The task could not be deleted",
                };
                return;
            }
            this.upcomingTasks = this.upcomingTasks.filter(
                (task) => task.taskId !== id
            );
        },
        async addUpcomingTask(e) {
            if (this.upcomingTasks.length > 4) {
                this.err = {
                    error: true,
                    id: "remaining-task-incomplete",
                    message: "Complete the following upcoming tasks first.",
                };
            }
            const newTask = {
                title: this.newTask,
                waiting: true,
                taskId: Math.random().toString(36).substring(7),
            };
            const res = await fetch("/api/upcoming", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(newTask),
            });
            const data = await res.json();
            this.upcomingTasks = [...this.upcomingTasks, data];
        },
        async addDailyTask(id) {
            console.log(this.todayTasks.find((task) => task.taskId === id));
            return;
            const newTask = await fetch("/api/upcoming/" + id);
            const data = await newTask.json();
            if (data.error === true) {
                his.err = {
                    error: true,
                    id: "task-not-found",
                    message: data.message,
                };
            }
            const res = await fetch("/api/dailytask", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(data),
            });
            const dataDailyTask = await res.json();
            this.todayTasks = [...this.todayTasks, dataDailyTask];
        },
    },
};
</script>

<style scoped>
#right {
    position: relative;
}
#error {
    position: absolute;
    background: rgb(255 50 50);
    top: 0;
    width: 80%;
    margin-top: 1em;
    left: 50%;
    transform: translateX(-50%);
    z-index: 11;
    border-radius: 10px;
    padding: 0.5em;
    color: white;
    font-weight: 800;
    font-family: inherit;
    font-size: 1rem;
}
</style>
