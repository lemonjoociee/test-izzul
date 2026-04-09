<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { router } from '@inertiajs/vue3'

const tasks = ref([])
const newTask = ref('')


const showModal = ref(false)
const editTask = ref({})


const fetchTasks = async () => {
    const res = await axios.get('/tasks')
    tasks.value = res.data
}

const addTask = async () => {
    if (!newTask.value) return
    await axios.post('/tasks', { title: newTask.value })
    newTask.value = ''
    fetchTasks()
}


const openEdit = (task) => {
    editTask.value = { ...task }
    showModal.value = true
}

const saveEdit = async () => {
    await axios.put(`/tasks/${editTask.value.id}`, {
        title: editTask.value.title
    })
    showModal.value = false
    fetchTasks()
}

const deleteTask = async (id) => {
    await axios.delete(`/tasks/${id}`)
    fetchTasks()
}


const logout = () => {
    router.post('/logout')
}

onMounted(fetchTasks)
</script>

<template>
<div class="min-h-screen bg-gray-100 flex flex-col">

  <!-- HEADER -->
  <header class="bg-blue-600 text-white p-4 flex justify-between items-center shadow">
    
    <h1 class="text-lg font-bold">📘 My ToDoList System</h1>

    <button 
        @click="logout"
        class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm"
    >
        Logout
    </button>

</header>

  <!-- MAIN -->
  <main class="flex-grow flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-xl">

      <h1 class="text-2xl font-bold mb-4 text-center">📝 Tasks</h1>

      <div class="flex gap-2 mb-4">
          <input 
              v-model="newTask" 
              class="border rounded p-2 w-full focus:ring-2 focus:ring-blue-400"
              placeholder="Enter task..."
          />
          <button 
              @click="addTask" 
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
          >
              Add
          </button>
      </div>

      <ul>
          <li 
              v-for="task in tasks" 
              :key="task.id" 
              class="flex justify-between items-center bg-gray-50 p-3 rounded mb-2"
          >
              <div class="flex items-center">
                  <input 
                      type="checkbox" 
                      :checked="task.is_completed" 
                      @change="updateTask(task)" 
                  />
                  <span 
                      :class="{ 'line-through text-gray-400': task.is_completed }" 
                      class="ml-2"
                  >
                      {{ task.title }}
                  </span>
              </div>

              <div class="flex gap-2">
                  <button 
                      @click="openEdit(task)" 
                      class="text-blue-500"
                  >
                      Edit
                  </button>

                  <button @click="deleteTask(task.id)" class="text-red-500">
                    Delete
                  </button>
              </div>
          </li>
      </ul>

    </div>
  </main>

  <!-- FOOTER -->
  <footer class="bg-gray-800 text-white text-center p-3 text-sm">
    © 2026 ToDoList App | Built with Laravel + Vue
  </footer>

  <!-- MODAL -->
  <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow w-96">
      <h2 class="text-lg font-bold mb-3">Edit Task</h2>

      <input 
        v-model="editTask.title" 
        class="border p-2 w-full mb-3"
      />

      <div class="flex justify-end gap-2">
        <button @click="showModal=false" class="px-3 py-1 border">Cancel</button>
        <button @click="saveEdit" class="bg-blue-500 text-white px-3 py-1">Save</button>
      </div>
    </div>
  </div>

</div>
</template>
