<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-neutral-950 dark:text-white">{{ employee.first_name }} {{ employee.last_name }}</h1>
        <Link href="/employees" class="text-neutral-600 dark:text-neutral-400 hover:text-neutral-950 dark:hover:text-white">
          ← Back to Employees
        </Link>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Employee Info Card -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700 p-6">
          <h2 class="text-xl font-semibold text-neutral-950 dark:text-white mb-4">Personal Information</h2>
          <div class="space-y-4">
            <div>
              <p class="text-sm text-neutral-600 dark:text-neutral-400">Employee ID</p>
              <p class="text-lg font-medium text-neutral-950 dark:text-white">{{ employee.employee_id }}</p>
            </div>
            <div>
              <p class="text-sm text-neutral-600 dark:text-neutral-400">Email</p>
              <p class="text-lg font-medium text-neutral-950 dark:text-white">{{ employee.email }}</p>
            </div>
            <div>
              <p class="text-sm text-neutral-600 dark:text-neutral-400">Phone</p>
              <p class="text-lg font-medium text-neutral-950 dark:text-white">{{ employee.phone || 'N/A' }}</p>
            </div>
            <div>
              <p class="text-sm text-neutral-600 dark:text-neutral-400">Status</p>
              <span :class="[
                'inline-block px-3 py-1 rounded-full text-sm font-medium mt-1',
                employee.status === 'active'
                  ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-900 dark:text-emerald-300'
                  : 'bg-neutral-100 dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400'
              ]">
                {{ employee.status }}
              </span>
            </div>
          </div>
        </div>

        <!-- Employment Info Card -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700 p-6">
          <h2 class="text-xl font-semibold text-neutral-950 dark:text-white mb-4">Employment Details</h2>
          <div class="space-y-4">
            <div>
              <p class="text-sm text-neutral-600 dark:text-neutral-400">Position</p>
              <p class="text-lg font-medium text-neutral-950 dark:text-white">{{ employee.position }}</p>
            </div>
            <div>
              <p class="text-sm text-neutral-600 dark:text-neutral-400">Base Salary</p>
              <p class="text-lg font-medium text-neutral-950 dark:text-white">${{ formatNumber(employee.base_salary) }}</p>
            </div>
            <div>
              <p class="text-sm text-neutral-600 dark:text-neutral-400">Hire Date</p>
              <p class="text-lg font-medium text-neutral-950 dark:text-white">{{ formatDate(employee.hire_date) }}</p>
            </div>
            <div>
              <p class="text-sm text-neutral-600 dark:text-neutral-400">Tenure</p>
              <p class="text-lg font-medium text-neutral-950 dark:text-white">{{ calculateTenure(employee.hire_date) }} years</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex gap-4 mt-8">
        <Link :href="`/employees/${employee.id}/edit`" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
          Edit Employee
        </Link>
        <button @click="deleteEmployee" class="bg-rose-600 hover:bg-rose-700 text-white px-6 py-2 rounded-lg font-medium transition">
          Delete Employee
        </button>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  employee: Object,
})

const formatNumber = (value) => {
  return new Intl.NumberFormat('en-US', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  }).format(value)
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  })
}

const calculateTenure = (hireDate) => {
  const start = new Date(hireDate)
  const now = new Date()
  const years = Math.floor((now - start) / (1000 * 60 * 60 * 24 * 365.25))
  return years
}

const deleteEmployee = () => {
  if (confirm('Are you sure you want to delete this employee?')) {
    const form = useForm({})
    form.delete(`/employees/${props.employee.id}`)
  }
}
</script>
