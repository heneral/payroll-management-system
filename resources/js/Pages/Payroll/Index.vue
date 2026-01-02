<template>
  <AppLayout>
    <div class="max-w-7xl mx-auto">
      <div class="flex justify-between items-center mb-8">
        <div>
          <h1 class="text-3xl font-semibold text-neutral-950 dark:text-white">Payroll</h1>
          <p class="text-neutral-600 dark:text-neutral-400 mt-2">Manage employee payroll</p>
        </div>
        <Link href="/payroll/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
          Process Payroll
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
            <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Period From</label>
            <input v-model="filters.period_from" type="date" class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white" />
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Period To</label>
            <input v-model="filters.period_to" type="date" class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white" />
          </div>
        </div>
      </div>

      <!-- Payroll Table -->
      <div class="bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700 overflow-hidden">
        <table class="w-full">
          <thead class="bg-neutral-50 dark:bg-neutral-900 border-b border-neutral-200 dark:border-neutral-700">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Employee</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Period</th>
              <th class="px-6 py-3 text-right text-sm font-semibold text-neutral-950 dark:text-white">Base Salary</th>
              <th class="px-6 py-3 text-right text-sm font-semibold text-neutral-950 dark:text-white">Allowances</th>
              <th class="px-6 py-3 text-right text-sm font-semibold text-neutral-950 dark:text-white">Deductions</th>
              <th class="px-6 py-3 text-right text-sm font-semibold text-neutral-950 dark:text-white">Net Pay</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Status</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="payroll in filteredPayroll" :key="payroll.id" class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-neutral-900/50">
              <td class="px-6 py-3 text-sm text-neutral-950 dark:text-white">{{ payroll.employee.first_name }} {{ payroll.employee.last_name }}</td>
              <td class="px-6 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ formatDate(payroll.period_start) }} - {{ formatDate(payroll.period_end) }}</td>
              <td class="px-6 py-3 text-sm text-right text-neutral-950 dark:text-white">${{ formatNumber(payroll.base_salary) }}</td>
              <td class="px-6 py-3 text-sm text-right text-emerald-600 dark:text-emerald-400">${{ formatNumber(payroll.total_allowances) }}</td>
              <td class="px-6 py-3 text-sm text-right text-rose-600 dark:text-rose-400">${{ formatNumber(payroll.total_deductions) }}</td>
              <td class="px-6 py-3 text-sm text-right font-semibold text-neutral-950 dark:text-white">${{ formatNumber(payroll.net_pay) }}</td>
              <td class="px-6 py-3 text-sm">
                <span :class="[
                  'px-3 py-1 rounded-full text-xs font-medium',
                  payroll.status === 'processed'
                    ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-900 dark:text-emerald-300'
                    : payroll.status === 'paid'
                    ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-900 dark:text-blue-300'
                    : 'bg-amber-100 dark:bg-amber-900/30 text-amber-900 dark:text-amber-300'
                ]">
                  {{ payroll.status }}
                </span>
              </td>
              <td class="px-6 py-3 text-sm">
                <Link :href="`/payroll/${payroll.id}`" class="text-blue-600 hover:text-blue-700 dark:hover:text-blue-400">View</Link>
              </td>
            </tr>
          </tbody>
        </table>
        <div v-if="filteredPayroll.length === 0" class="px-6 py-8 text-center text-neutral-500 dark:text-neutral-400">
          No payroll records found
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
  payroll: Array,
  employees: Array,
})

const filters = ref({
  employee_id: '',
  period_from: '',
  period_to: '',
})

const filteredPayroll = computed(() => {
  let result = props.payroll || []

  if (filters.value.employee_id) {
    result = result.filter(p => p.employee_id === parseInt(filters.value.employee_id))
  }

  if (filters.value.period_from) {
    result = result.filter(p => p.period_start >= filters.value.period_from)
  }

  if (filters.value.period_to) {
    result = result.filter(p => p.period_end <= filters.value.period_to)
  }

  return result
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
    month: 'short',
    day: 'numeric',
  })
}
</script>
