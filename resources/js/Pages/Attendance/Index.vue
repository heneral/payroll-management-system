<template>
  <AppLayout>
    <div class="max-w-7xl mx-auto">
      <div class="flex justify-between items-center mb-8">
        <div>
          <h1 class="text-3xl font-semibold text-neutral-950 dark:text-white">Attendance</h1>
          <p class="text-neutral-600 dark:text-neutral-400 mt-2">Track employee attendance</p>
        </div>
        <Link href="/attendance/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
          Record Attendance
        </Link>
      </div>

      <!-- Filters -->
      <div class="bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Employee</label>
            <select v-model="filters.employee_id" class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white">
              <option value="">All Employees</option>
              <option v-for="emp in employees" :key="emp.id" :value="emp.id">{{ emp.first_name }} {{ emp.last_name }}</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Date From</label>
            <input v-model="filters.date_from" type="date" class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white" />
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Date To</label>
            <input v-model="filters.date_to" type="date" class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white" />
          </div>
        </div>
      </div>

      <!-- Attendance Table -->
      <div class="bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700 overflow-hidden">
        <table class="w-full">
          <thead class="bg-neutral-50 dark:bg-neutral-900 border-b border-neutral-200 dark:border-neutral-700">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Employee</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Date</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Check In</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Check Out</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Status</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="record in filteredAttendance" :key="record.id" class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-neutral-900/50">
              <td class="px-6 py-3 text-sm text-neutral-950 dark:text-white">{{ record.employee.first_name }} {{ record.employee.last_name }}</td>
              <td class="px-6 py-3 text-sm text-neutral-950 dark:text-white">{{ formatDate(record.date) }}</td>
              <td class="px-6 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ record.check_in || '-' }}</td>
              <td class="px-6 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ record.check_out || '-' }}</td>
              <td class="px-6 py-3 text-sm">
                <span :class="[
                  'px-3 py-1 rounded-full text-xs font-medium',
                  record.status === 'present'
                    ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-900 dark:text-emerald-300'
                    : record.status === 'absent'
                    ? 'bg-rose-100 dark:bg-rose-900/30 text-rose-900 dark:text-rose-300'
                    : 'bg-amber-100 dark:bg-amber-900/30 text-amber-900 dark:text-amber-300'
                ]">
                  {{ record.status }}
                </span>
              </td>
              <td class="px-6 py-3 text-sm">
                <Link :href="`/attendance/${record.id}/edit`" class="text-blue-600 hover:text-blue-700 dark:hover:text-blue-400">Edit</Link>
              </td>
            </tr>
          </tbody>
        </table>
        <div v-if="filteredAttendance.length === 0" class="px-6 py-8 text-center text-neutral-500 dark:text-neutral-400">
          No attendance records found
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  attendance: Array,
  employees: Array,
})

const filters = ref({
  employee_id: '',
  date_from: '',
  date_to: '',
})

const filteredAttendance = computed(() => {
  let result = props.attendance || []

  if (filters.value.employee_id) {
    result = result.filter(a => a.employee_id === parseInt(filters.value.employee_id))
  }

  if (filters.value.date_from) {
    result = result.filter(a => a.date >= filters.value.date_from)
  }

  if (filters.value.date_to) {
    result = result.filter(a => a.date <= filters.value.date_to)
  }

  return result
})

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
  })
}
</script>
