<template>
  <AppLayout>
    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-4xl font-bold text-neutral-950 dark:text-white">Dashboard</h1>
        <p class="text-neutral-600 dark:text-neutral-400 mt-2">Welcome to your payroll management system</p>
      </div>

      <!-- Quick Stats -->
      <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-neutral-800 p-6 rounded-lg border border-neutral-200 dark:border-neutral-700">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-neutral-600 dark:text-neutral-400 text-sm uppercase font-medium">Total Employees</p>
              <p class="text-3xl font-bold text-neutral-950 dark:text-white mt-2">{{ stats.totalEmployees }}</p>
            </div>
            <div class="text-blue-500 text-3xl">👥</div>
          </div>
        </div>
        <div class="bg-white dark:bg-neutral-800 p-6 rounded-lg border border-neutral-200 dark:border-neutral-700">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-neutral-600 dark:text-neutral-400 text-sm uppercase font-medium">Active Employees</p>
              <p class="text-3xl font-bold text-neutral-950 dark:text-white mt-2">{{ stats.activeEmployees }}</p>
            </div>
            <div class="text-emerald-500 text-3xl">✓</div>
          </div>
        </div>
        <div class="bg-white dark:bg-neutral-800 p-6 rounded-lg border border-neutral-200 dark:border-neutral-700">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-neutral-600 dark:text-neutral-400 text-sm uppercase font-medium">Present Today</p>
              <p class="text-3xl font-bold text-neutral-950 dark:text-white mt-2">{{ stats.presentToday }}</p>
            </div>
            <div class="text-amber-500 text-3xl">📅</div>
          </div>
        </div>
        <div class="bg-white dark:bg-neutral-800 p-6 rounded-lg border border-neutral-200 dark:border-neutral-700">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-neutral-600 dark:text-neutral-400 text-sm uppercase font-medium">Total Payrolled</p>
              <p class="text-3xl font-bold text-neutral-950 dark:text-white mt-2">${{ formatNumber(stats.totalPayrolled) }}</p>
            </div>
            <div class="text-purple-500 text-3xl">💰</div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="grid md:grid-cols-4 gap-6 mb-8">
        <Link href="/employees" class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-lg border border-blue-700 transition">
          <div class="text-2xl mb-2">👥</div>
          <p class="font-semibold">Manage Employees</p>
        </Link>
        <Link href="/attendance" class="bg-emerald-600 hover:bg-emerald-700 text-white p-6 rounded-lg border border-emerald-700 transition">
          <div class="text-2xl mb-2">📅</div>
          <p class="font-semibold">Track Attendance</p>
        </Link>
        <Link href="/payroll" class="bg-purple-600 hover:bg-purple-700 text-white p-6 rounded-lg border border-purple-700 transition">
          <div class="text-2xl mb-2">💰</div>
          <p class="font-semibold">Process Payroll</p>
        </Link>
        <Link href="/payslips" class="bg-amber-600 hover:bg-amber-700 text-white p-6 rounded-lg border border-amber-700 transition">
          <div class="text-2xl mb-2">📄</div>
          <p class="font-semibold">View Payslips</p>
        </Link>
      </div>

      <!-- Recent Attendance -->
      <div class="bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700">
        <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
          <h2 class="text-xl font-semibold text-neutral-950 dark:text-white">Recent Attendance</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-neutral-50 dark:bg-neutral-900 border-b border-neutral-200 dark:border-neutral-700">
              <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Employee</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Date</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Check In</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-950 dark:text-white">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="record in recentAttendance" :key="record.id" class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-neutral-900/50">
                <td class="px-6 py-3 text-sm text-neutral-950 dark:text-white">{{ record.employee.first_name }} {{ record.employee.last_name }}</td>
                <td class="px-6 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ formatDate(record.date) }}</td>
                <td class="px-6 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ record.check_in || '-' }}</td>
                <td class="px-6 py-3 text-sm">
                  <span :class="[
                    'px-3 py-1 rounded-full text-xs font-medium',
                    record.status === 'present'
                      ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-900 dark:text-emerald-300'
                      : 'bg-amber-100 dark:bg-amber-900/30 text-amber-900 dark:text-amber-300'
                  ]">
                    {{ record.status }}
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
  stats: Object,
  recentAttendance: Array,
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

