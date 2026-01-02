<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Attendance Details</h1>
        <Link href="/attendance" class="px-4 py-2 bg-slate-600 text-white rounded hover:bg-slate-700">
          Back
        </Link>
      </div>

      <!-- Details Card -->
      <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg p-8">
        <div class="grid grid-cols-2 gap-8">
          <div>
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Employee Information</h2>
            <div class="space-y-3">
              <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Name</p>
                <p class="text-lg font-medium text-slate-900 dark:text-white">{{ record.employee.first_name }} {{ record.employee.last_name }}</p>
              </div>
              <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Employee ID</p>
                <p class="text-lg font-medium text-slate-900 dark:text-white">{{ record.employee.employee_id }}</p>
              </div>
              <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Position</p>
                <p class="text-lg font-medium text-slate-900 dark:text-white">{{ record.employee.position }}</p>
              </div>
            </div>
          </div>

          <div>
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-4">Attendance Record</h2>
            <div class="space-y-3">
              <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Date</p>
                <p class="text-lg font-medium text-slate-900 dark:text-white">{{ formatDate(record.date) }}</p>
              </div>
              <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Check In</p>
                <p class="text-lg font-medium text-slate-900 dark:text-white">{{ record.check_in || 'N/A' }}</p>
              </div>
              <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Check Out</p>
                <p class="text-lg font-medium text-slate-900 dark:text-white">{{ record.check_out || 'N/A' }}</p>
              </div>
              <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Status</p>
                <span :class="{
                  'bg-emerald-200 text-emerald-800': record.status === 'present',
                  'bg-rose-200 text-rose-800': record.status === 'absent',
                  'bg-amber-200 text-amber-800': record.status === 'late',
                  'bg-blue-200 text-blue-800': record.status === 'half-day',
                  'bg-purple-200 text-purple-800': record.status === 'on-leave',
                }" class="inline-block px-3 py-1 rounded-full text-sm font-semibold">
                  {{ record.status.charAt(0).toUpperCase() + record.status.slice(1) }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <div v-if="record.notes" class="mt-8 pt-8 border-t border-slate-300 dark:border-slate-600">
          <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-3">Notes</h3>
          <p class="text-slate-700 dark:text-slate-300">{{ record.notes }}</p>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex gap-4">
          <Link :href="`/attendance/${record.id}/edit`" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Edit
          </Link>
          <button @click="deleteRecord" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
            Delete
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  record: Object,
});

const formatDate = (date) => {
  if (!date) return '';
  const d = new Date(date);
  return d.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
};

const deleteRecord = () => {
  if (confirm('Are you sure?')) {
    // Delete logic would be implemented here
  }
};
</script>
