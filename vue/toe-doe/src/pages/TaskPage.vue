<template>
    <main style="min-height: 50vh; margin-top: 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Add new Task -->
                    <div class="relative">
                        <input type="text" class="form-control form-control-lg padding-right-lg"
                               placeholder="+ Add new task. Press enter to save." />
                    </div>
                    <!-- List of Completed tasks -->
                    <Tasks :tasks="completedTask"/>
                    <!-- Toggle Button -->

                    <!-- List of Uncompleted tasks -->
                    <Tasks :tasks="uncompletedTask"/>

                </div>
            </div>
        </div>
    </main>
</template>
<script setup>
import {computed, onMounted, ref} from "vue"
import {allTasks} from  '../http/tasks-api'
import Tasks from "@/components/tasks/Tasks.vue";

const tasks = ref([])

onMounted(async () => {
    const {data} = await allTasks()
    tasks.value = data.data
})

const uncompletedTask = computed(() => tasks.value.filter(task => !task.is_completed))
const completedTask = computed(() => tasks.value.filter(task => task.is_completed))


</script>
